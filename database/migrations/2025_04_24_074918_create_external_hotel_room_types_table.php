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
        Schema::create('external_hotel_room_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotel_data')->onDelete('cascade');
            $table->string('room_type')->nullable();
            $table->float('retail_price')->nullable();
            $table->float('b2b_price')->nullable();
            $table->integer('room_size')->nullable();
            $table->string('size_in')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_hotel_room_types');
    }
};
