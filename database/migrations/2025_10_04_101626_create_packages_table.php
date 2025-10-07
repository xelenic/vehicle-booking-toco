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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('short_description')->nullable();
            $table->string('duration');
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->json('images')->nullable(); // Multiple images
            $table->json('highlights')->nullable(); // Array of highlights
            $table->decimal('rating', 3, 1)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->enum('difficulty', ['Easy', 'Moderate', 'Hard'])->default('Easy');
            $table->string('group_size')->nullable();
            $table->text('included')->nullable(); // What's included
            $table->text('not_included')->nullable(); // What's not included
            $table->text('itinerary')->nullable(); // Detailed itinerary
            $table->text('requirements')->nullable(); // Requirements
            $table->text('cancellation_policy')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
