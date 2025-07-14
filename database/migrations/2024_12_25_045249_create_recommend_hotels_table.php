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
        Schema::create('recommend_hotels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('hotel_id')->unsigned();   
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade'); 
            
            $table->foreign('hotel_id')
                  ->references('id')->on('hotels')
                  ->onDelete('cascade');
            $table->tinyInteger('status')->default(0)->comment('0 is non recommend; 1 is recommend');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommend_hotels');
    }
};
