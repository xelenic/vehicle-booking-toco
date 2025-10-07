<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // Authenticated user booking
            $request->validate([
                'package_id' => 'required|exists:packages,id',
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'travel_date' => 'required|date|after:today',
                'travelers' => 'required|integer|min:1|max:20',
                'special_requirements' => 'nullable|string|max:1000',
            ]);

            $package = Package::findOrFail($request->package_id);
            
            $booking = Booking::create([
                'package_id' => $request->package_id,
                'user_id' => Auth::id(),
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'travel_date' => $request->travel_date,
                'travelers' => $request->travelers,
                'special_requirements' => $request->special_requirements,
                'total_amount' => $package->price * $request->travelers,
                'status' => 'pending',
                'payment_status' => 'pending',
            ]);

            // Redirect to payment
            return redirect()->route('payhere.initialize', ['booking_id' => $booking->id]);
        } else {
            // Guest booking with account creation
            $request->validate([
                'package_id' => 'required|exists:packages,id',
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'nullable|string|max:20',
                'travel_date' => 'required|date|after:today',
                'travelers' => 'required|integer|min:1|max:20',
                'special_requirements' => 'nullable|string|max:1000',
            ]);

            $package = Package::findOrFail($request->package_id);
            
            // Create user account
            $user = User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Assign user role to the newly created user
            $user->assignRole('user');

            // Create booking
            $booking = Booking::create([
                'package_id' => $request->package_id,
                'user_id' => $user->id,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'travel_date' => $request->travel_date,
                'travelers' => $request->travelers,
                'special_requirements' => $request->special_requirements,
                'total_amount' => $package->price * $request->travelers,
                'status' => 'pending',
                'payment_status' => 'pending',
            ]);

            // Auto-login the newly created user
            Auth::login($user);

            // Redirect to payment
            return redirect()->route('payhere.initialize', ['booking_id' => $booking->id]);
        }
    }
}