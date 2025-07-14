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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('city');
            $table->decimal('rating', 2, 1)->nullable();
            $table->text('address');
            // $table->string('city', 100);
            // $table->string('state', 100);
            // $table->string('country', 100);
            $table->string('zip_code', 20);
            $table->string('phone', 255);
            $table->string('email');
            $table->text('description')->nullable();
            $table->text('facility')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
