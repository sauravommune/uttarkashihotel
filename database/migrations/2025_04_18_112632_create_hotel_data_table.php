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
        Schema::create('hotel_data', function (Blueprint $table) {
            $table->id();
            $table->string('city')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('hotel')->nullable();
            $table->string('room_type')->nullable();
            $table->string('price_type')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('b2b_price', 10, 2)->nullable();
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->string('bed_type')->nullable();
            $table->string('extra_bed')->nullable();
            $table->string('parking')->nullable();
            $table->string('parking_type')->nullable();
            $table->json('amenities')->nullable(); 
            $table->string('guest_meal')->nullable();
            $table->json('breakfast')->nullable(); 
            $table->string('pet_allow')->nullable();
            $table->string('couple_friendly')->nullable();
            $table->string('banquet')->nullable();
            $table->string('conference')->nullable();
            $table->string('day_used_room')->nullable();
            $table->string('smoking_allowed')->nullable();
            $table->string('rating')->nullable();
            $table->string('room_size')->nullable();
            $table->string('size_in')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_data');
    }
};
