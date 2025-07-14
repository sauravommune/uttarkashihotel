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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('room_type')->nullable();
            $table->integer('total_room')->nullable();
            $table->text('description')->nullable();
            $table->integer('stay_gest')->nullable();
            $table->string('room_size')->nullable();
            $table->string('measure')->nullable();
            $table->string('smoking_allow')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
