<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MyBookingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user's bookings.
     */
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
            ->with([
                'package.category',
                'package.media',
                'vehicle',
                'pickupLocation',
                'destinationLocation'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('my-bookings.index', compact('bookings'));
    }

    /**
     * Display the specified booking.
     */
    public function show(Booking $booking)
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        $booking->load(['package', 'package.category', 'package.media', 'user']);

        return view('my-bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(Booking $booking)
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        // Only allow editing of pending bookings
        if ($booking->status !== 'pending') {
            return redirect()->route('my-bookings.show', $booking)
                ->with('error', 'Only pending bookings can be modified.');
        }

        $booking->load(['package', 'package.category', 'package.media']);
        $packages = Package::with(['category', 'media'])->get();

        return view('my-bookings.edit', compact('booking', 'packages'));
    }

    /**
     * Update the specified booking.
     */
    public function update(Request $request, Booking $booking)
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        // Only allow updating of pending bookings
        if ($booking->status !== 'pending') {
            return redirect()->route('my-bookings.show', $booking)
                ->with('error', 'Only pending bookings can be modified.');
        }

        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',
            'travel_date' => 'required|date|after:today',
            'travelers' => 'required|integer|min:1|max:20',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get the selected package
        $package = Package::findOrFail($request->package_id);

        // Calculate new total amount
        $totalAmount = $package->price * $request->travelers;

        // Update the booking
        $booking->update([
            'package_id' => $request->package_id,
            'travel_date' => $request->travel_date,
            'travelers' => $request->travelers,
            'total_amount' => $totalAmount,
            'special_requests' => $request->special_requests,
        ]);

        return redirect()->route('my-bookings.show', $booking)
            ->with('success', 'Booking updated successfully!');
    }

    /**
     * Cancel the specified booking.
     */
    public function cancel(Booking $booking)
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        // Only allow cancellation of pending bookings
        if ($booking->status !== 'pending') {
            return redirect()->route('my-bookings.show', $booking)
                ->with('error', 'Only pending bookings can be cancelled.');
        }

        $booking->update([
            'status' => 'cancelled',
            'payment_status' => 'cancelled',
        ]);

        return redirect()->route('my-bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Get booking statistics for the user.
     */
    public function stats()
    {
        $user = Auth::user();
        
        $stats = [
            'total_bookings' => Booking::where('user_id', $user->id)->count(),
            'pending_bookings' => Booking::where('user_id', $user->id)->where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('user_id', $user->id)->where('status', 'confirmed')->count(),
            'completed_bookings' => Booking::where('user_id', $user->id)->where('status', 'completed')->count(),
            'cancelled_bookings' => Booking::where('user_id', $user->id)->where('status', 'cancelled')->count(),
            'total_spent' => Booking::where('user_id', $user->id)->where('payment_status', 'paid')->sum('total_amount'),
        ];

        return response()->json($stats);
    }
}
