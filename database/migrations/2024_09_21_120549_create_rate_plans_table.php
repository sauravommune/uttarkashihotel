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
        Schema::create('rate_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_type');
            $table->foreign('room_type')->references('id')->on('rooms')->onDelete('cascade');
            $table->unsignedBigInteger('hotel_id'); // Add hotel_id here
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->decimal('b2b_rate_ep', 10, 2); // EP rate
            $table->decimal('b2b_rate_cp', 10, 2); // CP rate
            $table->decimal('b2b_rate_map', 10, 2); // MAP rate
            $table->decimal('markup_ep', 10, 2)->nullable(); // EP markup
            $table->decimal('markup_cp', 10, 2)->nullable(); // CP markup
            $table->decimal('markup_map', 10, 2)->nullable(); // MAP markup
            $table->decimal('total_amount_ep', 10, 2)->nullable(); // EP total
            $table->decimal('total_amount_cp', 10, 2)->nullable(); // CP total
            $table->decimal('total_amount_map', 10, 2)->nullable(); // MAP total
            $table->decimal('non_refundable_rate', 10, 2)->nullable(); //
            $table->decimal('weekly_rate', 10, 2)->nullable(); //
            $table->date('pricing_start_date');
            $table->date('pricing_end_date');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->timestamp('created_on')->nullable();
            $table->timestamp('margin_updated_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_plans');
    }
};
