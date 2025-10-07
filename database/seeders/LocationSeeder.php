<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Colombo',
                'latitude' => 6.9271,
                'longitude' => 79.8612,
                'description' => 'Capital city of Sri Lanka, commercial hub with modern infrastructure.',
                'is_active' => true,
            ],
            [
                'name' => 'Kandy',
                'latitude' => 7.2906,
                'longitude' => 80.6337,
                'description' => 'Cultural capital of Sri Lanka, home to the Temple of the Sacred Tooth Relic.',
                'is_active' => true,
            ],
            [
                'name' => 'Galle',
                'latitude' => 6.0329,
                'longitude' => 80.2170,
                'description' => 'Historic coastal city with Dutch colonial architecture and beautiful beaches.',
                'is_active' => true,
            ],
            [
                'name' => 'Sigiriya',
                'latitude' => 7.9569,
                'longitude' => 80.7597,
                'description' => 'Ancient rock fortress and UNESCO World Heritage site.',
                'is_active' => true,
            ],
            [
                'name' => 'Anuradhapura',
                'latitude' => 8.3114,
                'longitude' => 80.4037,
                'description' => 'Ancient capital of Sri Lanka with sacred Buddhist sites.',
                'is_active' => true,
            ],
            [
                'name' => 'Polonnaruwa',
                'latitude' => 7.9403,
                'longitude' => 81.0187,
                'description' => 'Medieval capital with well-preserved ruins and ancient architecture.',
                'is_active' => true,
            ],
            [
                'name' => 'Ella',
                'latitude' => 6.8667,
                'longitude' => 81.0333,
                'description' => 'Mountain town famous for scenic train rides and hiking trails.',
                'is_active' => true,
            ],
            [
                'name' => 'Nuwara Eliya',
                'latitude' => 6.9497,
                'longitude' => 80.7891,
                'description' => 'Hill station known as Little England, famous for tea plantations.',
                'is_active' => true,
            ],
            [
                'name' => 'Mirissa',
                'latitude' => 5.9494,
                'longitude' => 80.4561,
                'description' => 'Coastal town famous for whale watching and beautiful beaches.',
                'is_active' => true,
            ],
            [
                'name' => 'Yala National Park',
                'latitude' => 6.3728,
                'longitude' => 81.5242,
                'description' => 'Famous wildlife sanctuary known for leopard sightings and diverse fauna.',
                'is_active' => true,
            ],
            [
                'name' => 'Bentota',
                'latitude' => 6.4167,
                'longitude' => 80.0000,
                'description' => 'Popular beach destination with water sports and luxury resorts.',
                'is_active' => true,
            ],
            [
                'name' => 'Trincomalee',
                'latitude' => 8.5874,
                'longitude' => 81.2152,
                'description' => 'Natural harbor city with beautiful beaches and diving opportunities.',
                'is_active' => true,
            ],
            [
                'name' => 'Jaffna',
                'latitude' => 9.6615,
                'longitude' => 80.0255,
                'description' => 'Northern city with rich Tamil culture and historical significance.',
                'is_active' => true,
            ],
            [
                'name' => 'Negombo',
                'latitude' => 7.2086,
                'longitude' => 79.8358,
                'description' => 'Coastal city near Colombo airport, popular for fishing and beaches.',
                'is_active' => true,
            ],
            [
                'name' => 'Dambulla',
                'latitude' => 7.8567,
                'longitude' => 80.6517,
                'description' => 'Town famous for the Dambulla Cave Temple, a UNESCO World Heritage site.',
                'is_active' => true,
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
