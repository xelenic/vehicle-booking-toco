<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Vehicle name
            $table->string('registration_number')->unique(); // Vehicle registration number
            $table->enum('type', ['car', 'lorry', 'van', 'bus', 'jeep', 'tuk_tuk', 'motorcycle']); // Vehicle type
            $table->integer('pax_count'); // Maximum passenger count
            $table->integer('passenger_count'); // Current passenger count
            $table->decimal('first_1km_price', 10, 2); // Price for first 1km
            $table->decimal('after_100m_price', 10, 2); // Price for every 100m after first km
            $table->json('available_locations'); // Available locations (JSON array)
            $table->string('driver_name')->nullable(); // Driver name
            $table->string('driver_phone')->nullable(); // Driver phone number
            $table->string('driver_license')->nullable(); // Driver license number
            $table->year('manufacturing_year')->nullable(); // Manufacturing year
            $table->string('brand')->nullable(); // Vehicle brand
            $table->string('model')->nullable(); // Vehicle model
            $table->string('color')->nullable(); // Vehicle color
            $table->string('fuel_type')->default('petrol'); // Fuel type (petrol, diesel, hybrid, electric)
            $table->decimal('fuel_capacity', 8, 2)->nullable(); // Fuel tank capacity
            $table->decimal('mileage', 8, 2)->nullable(); // Vehicle mileage
            $table->json('features')->nullable(); // Vehicle features (AC, GPS, etc.)
            $table->json('amenities')->nullable(); // Vehicle amenities
            $table->text('description')->nullable(); // Vehicle description
            $table->string('image')->nullable(); // Vehicle image
            $table->json('images')->nullable(); // Multiple vehicle images
            $table->enum('status', ['available', 'busy', 'maintenance', 'out_of_service'])->default('available');
            $table->boolean('is_active')->default(true);
            $table->decimal('insurance_amount', 12, 2)->nullable(); // Insurance amount
            $table->date('insurance_expiry')->nullable(); // Insurance expiry date
            $table->decimal('maintenance_cost', 10, 2)->nullable(); // Last maintenance cost
            $table->date('last_maintenance_date')->nullable(); // Last maintenance date
            $table->date('next_maintenance_date')->nullable(); // Next maintenance date
            $table->text('notes')->nullable(); // Additional notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};