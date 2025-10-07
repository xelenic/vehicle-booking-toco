<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // Get some packages and users for bookings
        $packages = Package::all();
        $users = User::all();
        
        if ($packages->isEmpty()) {
            $this->command->warn('No packages found. Please run PackageSeeder first.');
            return;
        }

        $sampleBookings = [
            [
                'package_id' => $packages->random()->id,
                'user_id' => $users->isNotEmpty() ? $users->random()->id : null,
                'full_name' => 'John Smith',
                'email' => 'john.smith@email.com',
                'phone' => '+1-555-0123',
                'travel_date' => Carbon::now()->addDays(15),
                'travelers' => 2,
                'special_requirements' => 'Vegetarian meals required. Need wheelchair accessible accommodation.',
                'total_amount' => 0, // Will be calculated
                'status' => 'pending',
                'admin_notes' => 'Customer requested vegetarian meals and wheelchair access.',
            ],
            [
                'package_id' => $packages->random()->id,
                'user_id' => $users->isNotEmpty() ? $users->random()->id : null,
                'full_name' => 'Sarah Johnson',
                'email' => 'sarah.j@email.com',
                'phone' => '+1-555-0456',
                'travel_date' => Carbon::now()->addDays(30),
                'travelers' => 4,
                'special_requirements' => 'Family with 2 children (ages 8 and 12).',
                'total_amount' => 0, // Will be calculated
                'status' => 'confirmed',
                'admin_notes' => 'Family booking confirmed. Children activities arranged.',
            ],
            [
                'package_id' => $packages->random()->id,
                'user_id' => $users->isNotEmpty() ? $users->random()->id : null,
                'full_name' => 'Michael Brown',
                'email' => 'mike.brown@email.com',
                'phone' => '+1-555-0789',
                'travel_date' => Carbon::now()->subDays(5),
                'travelers' => 1,
                'special_requirements' => null,
                'total_amount' => 0, // Will be calculated
                'status' => 'completed',
                'admin_notes' => 'Solo traveler. Tour completed successfully. Customer was very satisfied.',
            ],
            [
                'package_id' => $packages->random()->id,
                'user_id' => $users->isNotEmpty() ? $users->random()->id : null,
                'full_name' => 'Emily Davis',
                'email' => 'emily.davis@email.com',
                'phone' => '+1-555-0321',
                'travel_date' => Carbon::now()->addDays(45),
                'travelers' => 3,
                'special_requirements' => 'Anniversary trip. Prefer romantic settings.',
                'total_amount' => 0, // Will be calculated
                'status' => 'pending',
                'admin_notes' => 'Anniversary booking. Consider romantic dinner arrangements.',
            ],
            [
                'package_id' => $packages->random()->id,
                'user_id' => $users->isNotEmpty() ? $users->random()->id : null,
                'full_name' => 'Robert Wilson',
                'email' => 'robert.w@email.com',
                'phone' => '+1-555-0654',
                'travel_date' => Carbon::now()->addDays(20),
                'travelers' => 2,
                'special_requirements' => null,
                'total_amount' => 0, // Will be calculated
                'status' => 'cancelled',
                'admin_notes' => 'Customer cancelled due to personal reasons. Full refund processed.',
            ],
            [
                'package_id' => $packages->random()->id,
                'user_id' => null, // Guest booking
                'full_name' => 'Lisa Anderson',
                'email' => 'lisa.anderson@email.com',
                'phone' => '+1-555-0987',
                'travel_date' => Carbon::now()->addDays(60),
                'travelers' => 6,
                'special_requirements' => 'Group booking for corporate team building.',
                'total_amount' => 0, // Will be calculated
                'status' => 'confirmed',
                'admin_notes' => 'Corporate group booking. Special team building activities arranged.',
            ],
        ];

        foreach ($sampleBookings as $bookingData) {
            $package = Package::find($bookingData['package_id']);
            $bookingData['total_amount'] = $package->price * $bookingData['travelers'];
            
            Booking::create($bookingData);
        }

        $this->command->info('Sample bookings created successfully!');
    }
}