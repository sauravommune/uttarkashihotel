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
        Schema::table('hotel_data', function (Blueprint $table) {
            //
            $table->json('meal_offered')->nullable();
            $table->dropColumn('room_type');
            $table->dropColumn('price');
            $table->dropColumn('b2b_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_data', function (Blueprint $table) {
            //
            $table->dropColumn('meal_offered');
            $table->json('room_type')->nullable();
            $table->float('price')->nullable();
            $table->float('b2b_price')->nullable();
            $table->integer('room_size')->nullable();
            $table->string('size_in')->nullable();
        });
    }
};
