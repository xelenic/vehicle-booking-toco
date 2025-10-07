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
        Schema::table('vehicles', function (Blueprint $table) {
            // Rename columns to match the model
            $table->renameColumn('first_1km_price', 'price_first_km');
            $table->renameColumn('after_100m_price', 'price_per_100m_after');
            $table->renameColumn('driver_license', 'driver_license_number');
            $table->renameColumn('insurance_expiry', 'insurance_expiry_date');
            $table->renameColumn('maintenance_cost', 'last_maintenance_cost');
            $table->renameColumn('notes', 'admin_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Reverse the column renames
            $table->renameColumn('price_first_km', 'first_1km_price');
            $table->renameColumn('price_per_100m_after', 'after_100m_price');
            $table->renameColumn('driver_license_number', 'driver_license');
            $table->renameColumn('insurance_expiry_date', 'insurance_expiry');
            $table->renameColumn('last_maintenance_cost', 'maintenance_cost');
            $table->renameColumn('admin_notes', 'notes');
        });
    }
};