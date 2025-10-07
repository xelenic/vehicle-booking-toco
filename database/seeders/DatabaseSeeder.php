<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions first
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Seed admin users
        $this->call([
            AdminSeeder::class,
        ]);

        // Seed package categories and packages
        $this->call([
            PackageCategorySeeder::class,
            PackageSeeder::class,
        ]);

        // Seed blog categories and blogs
        $this->call([
            BlogCategorySeeder::class,
            BlogSeeder::class,
        ]);

        // Seed reviews
        $this->call([
            ReviewSeeder::class,
        ]);

        // Seed bookings
        $this->call([
            BookingSeeder::class,
        ]);

        // Seed locations
        $this->call([
            LocationSeeder::class,
        ]);
    }
}
