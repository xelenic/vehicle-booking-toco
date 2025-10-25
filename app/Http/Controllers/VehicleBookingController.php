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

        // Determine effective pricing type based on available pricing data
        $effectivePricingType = $this->getEffectivePricingType($vehicle);
        
        if ($effectivePricingType === 'standard') {
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
            $firstKmPrice = $vehicle->price_first_km;
            $per100mPrice = $vehicle->price_per_100m_after;
            
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

        // Get location names for response
        $pickupLocation = Location::findOrFail($request->pickup_location_id);
        $destinationLocation = Location::findOrFail($request->destination_location_id);

        return response()->json([
            'success' => true,
            'data' => [
                'total_price' => round($totalPrice, 2),
                'formatted_price' => 'LKR ' . number_format($totalPrice, 2),
                'distance' => round($distance, 2),
                'vehicle_name' => $vehicle->name,
                'vehicle_type' => ucfirst(str_replace('_', ' ', $vehicle->type)),
                'pricing_type' => $effectivePricingType,
                'price_breakdown' => $this->formatPriceBreakdown($priceBreakdown),
                'pickup_location' => $pickupLocation->name,
                'destination_location' => $destinationLocation->name,
                'route_description' => $pickupLocation->name . ' → ' . $destinationLocation->name
            ]
        ]);
    }

    /**
     * Get effective pricing type based on available pricing data
     */
    private function getEffectivePricingType($vehicle)
    {
        // If per_km_price is available, use standard pricing
        if ($vehicle->per_km_price && $vehicle->per_km_price > 0) {
            return 'standard';
        }
        
        // If first_km_price and per_100m_price are available, use first_km_meter pricing
        if ($vehicle->price_first_km && $vehicle->price_per_100m_after && 
            $vehicle->price_first_km > 0 && $vehicle->price_per_100m_after > 0) {
            return 'first_km_meter';
        }
        
        // Default to standard
        return 'standard';
    }

    /**
     * Format price breakdown for display
     */
    private function formatPriceBreakdown($priceBreakdown)
    {
        $formatted = [];
        
        if ($priceBreakdown['type'] === 'standard') {
            $formatted[] = "Per km rate: LKR " . number_format($priceBreakdown['per_km_price'] ?? 0, 2);
            $formatted[] = "Distance: " . number_format($priceBreakdown['distance_km'], 2) . "km";
        } else {
            $formatted[] = "First 1km: LKR " . number_format($priceBreakdown['first_km_price'] ?? 0, 2);
            if (($priceBreakdown['additional_distance'] ?? 0) > 0) {
                $formatted[] = "Additional " . number_format($priceBreakdown['additional_distance'], 2) . "km: LKR " . number_format($priceBreakdown['additional_price'] ?? 0, 2);
            }
        }
        
        return $formatted;
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

    /**
     * Submit booking order
     */
    public function submit(Request $request)
    {
        try {
            $request->validate([
                'pickupLocation' => 'required|string',
                'destinationLocation' => 'required|string',
                'pickupDate' => 'required|date',
                'pickupTime' => 'required|string',
                'vehicle' => 'required|string',
                'vehicleId' => 'required|exists:vehicles,id',
                'passengers' => 'required|integer|min:1',
                'locationIds.pickup' => 'required|exists:locations,id',
                'locationIds.destination' => 'required|exists:locations,id',
                'customerDetails.fullName' => 'required|string|max:255',
                'customerDetails.email' => 'required|email|max:255',
                'customerDetails.phone' => 'required|string|max:20',
                'customerDetails.password' => 'nullable|string|min:6',
                'customerDetails.specialRequirements' => 'nullable|string'
            ]);

            // Check if user is authenticated
            $user = Auth::user();
            
            // If not authenticated, check if user exists
            if (!$user) {
                $user = User::where('email', $request->customerDetails['email'])->first();
                
                if ($user) {
                    // Existing user - verify password
                    if (!empty($request->customerDetails['password'])) {
                        if (Hash::check($request->customerDetails['password'], $user->password)) {
                            // Password matches, log in the user
                            Auth::login($user);
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Incorrect password. Please try again.'
                            ], 401);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Password required for existing user.'
                        ], 401);
                    }
                } else {
                    // New user - create account
                    if (empty($request->customerDetails['password'])) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Password required to create a new account.'
                        ], 422);
                    }
                    
                    $user = User::create([
                        'name' => $request->customerDetails['fullName'],
                        'email' => $request->customerDetails['email'],
                        'password' => Hash::make($request->customerDetails['password']),
                    ]);
                    
                    // Log in the newly created user
                    Auth::login($user);
                }
            }

            // Get locations
            $pickupLocation = Location::findOrFail($request->locationIds['pickup']);
            $destinationLocation = Location::findOrFail($request->locationIds['destination']);
            
            // Get vehicle
            $vehicle = Vehicle::findOrFail($request->vehicleId);
            
            // Calculate distance (you might want to calculate this based on coordinates)
            // For now, we'll use a default value or calculate from locations
            $distance = $this->calculateDistance(
                $pickupLocation->latitude,
                $pickupLocation->longitude,
                $destinationLocation->latitude,
                $destinationLocation->longitude
            );
            
            // Calculate total price
            $totalPrice = 0;
            $effectivePricingType = $this->getEffectivePricingType($vehicle);
            
            if ($effectivePricingType === 'standard') {
                $totalPrice = $distance * $vehicle->per_km_price;
            } else {
                $firstKmPrice = $vehicle->price_first_km;
                $per100mPrice = $vehicle->price_per_100m_after;
                
                if ($distance <= 1) {
                    $totalPrice = $firstKmPrice;
                } else {
                    $additionalDistance = $distance - 1;
                    $additionalDistanceMeters = $additionalDistance * 1000;
                    $additionalPrice = ceil($additionalDistanceMeters / 100) * $per100mPrice;
                    $totalPrice = $firstKmPrice + $additionalPrice;
                }
            }

            // Create booking
            $booking = Booking::create([
                'user_id' => $user->id,
                'vehicle_id' => $vehicle->id,
                'pickup_location_id' => $pickupLocation->id,
                'destination_location_id' => $destinationLocation->id,
                'pickup_date' => $request->pickupDate,
                'pickup_time' => $request->pickupTime,
                'travel_date' => $request->pickupDate,
                'passengers' => $request->passengers,
                'full_name' => $request->customerDetails['fullName'],
                'email' => $request->customerDetails['email'],
                'phone' => $request->customerDetails['phone'],
                'distance' => round($distance, 2),
                'total_amount' => round($totalPrice, 2),
                'special_requirements' => $request->customerDetails['specialRequirements'] ?? null,
                'status' => 'pending',
                'payment_status' => 'pending',
                'booking_type' => 'vehicle'
            ]);

            Log::info('Booking created successfully', [
                'booking_id' => $booking->id,
                'user_id' => $user->id,
                'vehicle_id' => $vehicle->id,
                'total_amount' => $totalPrice
            ]);

            // Generate payment URL for PayHere
            $paymentUrl = route('payhere.initialize', ['booking_id' => $booking->id]);

            return response()->json([
                'success' => true,
                'message' => 'Booking submitted successfully! Redirecting to payment...',
                'booking' => [
                    'id' => $booking->id,
                    'reference_number' => 'BK-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT),
                    'total_amount' => round($totalPrice, 2),
                    'formatted_price' => 'LKR ' . number_format($totalPrice, 2)
                ],
                'payment_url' => $paymentUrl
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating booking', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit booking. Please try again or contact support.'
            ], 500);
        }
    }

    /**
     * Calculate distance between two coordinates using Haversine formula
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Earth's radius in kilometers
        
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        return $earthRadius * $c; // Distance in kilometers
    }
}