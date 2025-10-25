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
            // Add vehicle and location fields if they don't exist
            if (!Schema::hasColumn('bookings', 'vehicle_id')) {
                $table->foreignId('vehicle_id')->nullable()->after('package_id');
            }
            if (!Schema::hasColumn('bookings', 'pickup_location_id')) {
                $table->foreignId('pickup_location_id')->nullable()->after('vehicle_id');
            }
            if (!Schema::hasColumn('bookings', 'destination_location_id')) {
                $table->foreignId('destination_location_id')->nullable()->after('pickup_location_id');
            }
            if (!Schema::hasColumn('bookings', 'pickup_date')) {
                $table->date('pickup_date')->nullable()->after('travel_date');
            }
            if (!Schema::hasColumn('bookings', 'pickup_time')) {
                $table->time('pickup_time')->nullable()->after('pickup_date');
            }
            if (!Schema::hasColumn('bookings', 'passengers')) {
                $table->integer('passengers')->default(1)->after('travelers');
            }
            if (!Schema::hasColumn('bookings', 'distance')) {
                $table->decimal('distance', 8, 2)->nullable()->after('passengers');
            }
            if (!Schema::hasColumn('bookings', 'booking_type')) {
                $table->string('booking_type')->default('package')->after('distance');
            }
            if (!Schema::hasColumn('bookings', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'paid', 'refunded'])->default('pending')->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'vehicle_id')) {
                $table->dropForeign(['vehicle_id']);
                $table->dropColumn('vehicle_id');
            }
            if (Schema::hasColumn('bookings', 'pickup_location_id')) {
                $table->dropForeign(['pickup_location_id']);
                $table->dropColumn('pickup_location_id');
            }
            if (Schema::hasColumn('bookings', 'destination_location_id')) {
                $table->dropForeign(['destination_location_id']);
                $table->dropColumn('destination_location_id');
            }
            $table->dropColumn([
                'pickup_date',
                'pickup_time',
                'passengers',
                'distance',
                'booking_type',
                'payment_status'
            ]);
        });
    }
};
