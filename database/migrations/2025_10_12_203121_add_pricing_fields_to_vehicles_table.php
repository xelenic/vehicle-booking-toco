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
            $table->enum('pricing_type', ['standard', 'first_km_meter'])->default('standard')->after('pax_count');
            $table->decimal('per_km_price', 10, 2)->nullable()->after('pricing_type');
            $table->decimal('first_km_price', 10, 2)->nullable()->after('per_km_price');
            $table->decimal('per_100m_price', 10, 2)->nullable()->after('first_km_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['pricing_type', 'per_km_price', 'first_km_price', 'per_100m_price']);
        });
    }
};
