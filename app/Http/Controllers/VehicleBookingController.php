<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Location;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class VehicleBookingController extends Controller
{
    /**
     * Calculate vehicle pricing based on distance and pricing type
     */
    public function calculatePrice(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'pickup_location_id' => 'required|exists:locations,id',
            'destination_location_id' => 'required|exists:locations,id',
            'distance' => 'required|numeric|min:0'
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        $distance = $request->distance; // Distance in kilometers

        $totalPrice = 0;
        $priceBreakdown = [];

        if ($vehicle->pricing_type === 'standard') {
            // Standard pricing: per km
            $totalPrice = $distance * $vehicle->per_km_price;
            $priceBreakdown = [
                'type' => 'standard',
                'distance_km' => $distance,
                'per_km_price' => $vehicle->per_km_price,
                'total' => $totalPrice
            ];
        } else {
            // First KM + Per 100m pricing
            $firstKmPrice = $vehicle->first_km_price;
            $per100mPrice = $vehicle->per_100m_price;
            
            if ($distance <= 1) {
                // Distance is 1km or less
                $totalPrice = $firstKmPrice;
                $priceBreakdown = [
                    'type' => 'first_km_meter',
                    'distance_km' => $distance,
                    'first_km_price' => $firstKmPrice,
                    'additional_distance' => 0,
                    'additional_price' => 0,
                    'total' => $totalPrice
                ];
            } else {
                // Distance is more than 1km
                $additionalDistance = $distance - 1; // Distance after first km
                $additionalDistanceMeters = $additionalDistance * 1000; // Convert to meters
                $additionalPrice = ceil($additionalDistanceMeters / 100) * $per100mPrice; // Round up to nearest 100m
                
                $totalPrice = $firstKmPrice + $additionalPrice;
                $priceBreakdown = [
                    'type' => 'first_km_meter',
                    'distance_km' => $distance,
                    'first_km_price' => $firstKmPrice,
                    'additional_distance' => $additionalDistance,
                    'additional_distance_meters' => $additionalDistanceMeters,
                    'per_100m_price' => $per100mPrice,
                    'additional_price' => $additionalPrice,
                    'total' => $totalPrice
                ];
            }
        }

        return response()->json([
            'success' => true,
            'vehicle' => [
                'id' => $vehicle->id,
                'name' => $vehicle->name,
                'type' => $vehicle->type,
                'pax_count' => $vehicle->pax_count,
                'pricing_type' => $vehicle->pricing_type
            ],
            'price_breakdown' => $priceBreakdown,
            'total_price' => $totalPrice,
            'formatted_price' => 'LKR ' . number_format($totalPrice, 2)
        ]);
    }

    /**
     * Create vehicle booking
     */
    public function createBooking(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'pickup_location_id' => 'required|exists:locations,id',
            'destination_location_id' => 'required|exists:locations,id',
            'pickup_date' => 'required|date|after:today',
            'pickup_time' => 'required',
            'pax_count' => 'required|integer|min:1|max:20',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'distance' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'special_requirements' => 'nullable|string|max:1000'
        ]);

        try {
            $vehicle = Vehicle::findOrFail($request->vehicle_id);
            $pickupLocation = Location::findOrFail($request->pickup_location_id);
            $destinationLocation = Location::findOrFail($request->destination_location_id);

            // Validate passenger count against vehicle capacity
            if ($request->pax_count > $vehicle->pax_count) {
                return response()->json([
                    'success' => false,
                    'message' => "Maximum {$vehicle->pax_count} passengers allowed for selected vehicle"
                ], 400);
            }

            // Check if user exists, if not create one
            $user = User::where('email', $request->email)->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $request->full_name,
                    'email' => $request->email,
                    'password' => Hash::make('temp_password_' . time()), // Temporary password
                    'phone' => $request->phone,
                ]);

                // Assign user role
                $user->assignRole('user');
            }

            // Create vehicle booking
            $booking = Booking::create([
                'package_id' => null, // Vehicle booking doesn't have package
                'user_id' => $user->id,
                'vehicle_id' => $vehicle->id,
                'pickup_location_id' => $pickupLocation->id,
                'destination_location_id' => $destinationLocation->id,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'travel_date' => $request->pickup_date,
                'pickup_time' => $request->pickup_time,
                'travelers' => $request->pax_count,
                'distance' => $request->distance,
                'total_amount' => $request->total_price,
                'special_requirements' => $request->special_requirements,
                'status' => 'pending',
                'payment_status' => 'pending',
                'booking_type' => 'vehicle' // Mark as vehicle booking
            ]);

            // Auto-login the user
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Vehicle booking created successfully',
                'booking_id' => $booking->id,
                'redirect_url' => route('payhere.initialize', ['booking_id' => $booking->id])
            ]);

        } catch (\Exception $e) {
            Log::error('Vehicle booking creation failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating your booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get booking details for confirmation
     */
    public function getBookingDetails($bookingId)
    {
        $booking = Booking::with(['vehicle', 'pickupLocation', 'destinationLocation', 'user'])
            ->where('booking_type', 'vehicle')
            ->findOrFail($bookingId);

        return response()->json([
            'success' => true,
            'booking' => [
                'id' => $booking->id,
                'vehicle_name' => $booking->vehicle->name,
                'vehicle_type' => $booking->vehicle->type,
                'pickup_location' => $booking->pickupLocation->name,
                'destination_location' => $booking->destinationLocation->name,
                'pickup_date' => $booking->travel_date,
                'pickup_time' => $booking->pickup_time,
                'passengers' => $booking->travelers,
                'distance' => $booking->distance,
                'total_amount' => $booking->total_amount,
                'formatted_price' => 'LKR ' . number_format($booking->total_amount, 2),
                'full_name' => $booking->full_name,
                'email' => $booking->email,
                'phone' => $booking->phone,
                'special_requirements' => $booking->special_requirements,
                'status' => $booking->status,
                'payment_status' => $booking->payment_status
            ]
        ]);
    }
}