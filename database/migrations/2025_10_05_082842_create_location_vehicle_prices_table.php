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
        Schema::create('location_vehicle_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pickup_location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('destination_location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Ensure unique combination of pickup, destination, and vehicle
            $table->unique(['pickup_location_id', 'destination_location_id', 'vehicle_id'], 'unique_route_vehicle');
            
            // Add indexes for better performance with custom names
            $table->index(['pickup_location_id', 'destination_location_id'], 'lvp_pickup_dest_idx');
            $table->index('vehicle_id', 'lvp_vehicle_idx');
            $table->index('is_active', 'lvp_active_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_vehicle_prices');
    }
};
