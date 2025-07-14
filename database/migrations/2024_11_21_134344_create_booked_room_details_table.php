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
        Schema::create('booked_room_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('bookings')->onDelete('cascade')->comment('random generated booking id');
            $table->unsignedBigInteger('rate_plan');
            $table->foreign('rate_plan')->references('id')->on('rate_plans')->onDelete('cascade');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->unsignedBigInteger('room_category');
            $table->foreign('room_category')->references('id')->on('room_categories')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->string('booking_id');
            // $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
            $table->string('break_fast_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_room_details');
    }
};
