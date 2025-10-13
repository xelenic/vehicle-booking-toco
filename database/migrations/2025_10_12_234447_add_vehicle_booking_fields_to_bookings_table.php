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
        Schema::table('bookings', function (Blueprint $table) {
            // Only add columns that don't exist
            if (!Schema::hasColumn('bookings', 'pickup_time')) {
                $table->time('pickup_time')->nullable()->after('travel_date');
            }
            if (!Schema::hasColumn('bookings', 'distance')) {
                $table->decimal('distance', 8, 2)->nullable()->after('pickup_time');
            }
            if (!Schema::hasColumn('bookings', 'booking_type')) {
                $table->string('booking_type')->default('package')->after('distance');
            }
            
            // Add foreign key constraints if they don't exist
            if (Schema::hasColumn('bookings', 'vehicle_id') && !Schema::hasColumn('bookings', 'vehicle_id')) {
                $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
            }
            if (Schema::hasColumn('bookings', 'pickup_location_id') && !Schema::hasColumn('bookings', 'pickup_location_id')) {
                $table->foreign('pickup_location_id')->references('id')->on('locations')->onDelete('set null');
            }
            if (Schema::hasColumn('bookings', 'destination_location_id') && !Schema::hasColumn('bookings', 'destination_location_id')) {
                $table->foreign('destination_location_id')->references('id')->on('locations')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropForeign(['pickup_location_id']);
            $table->dropForeign(['destination_location_id']);
            $table->dropColumn(['vehicle_id', 'pickup_location_id', 'destination_location_id', 'pickup_time', 'distance', 'booking_type']);
        });
    }
};
