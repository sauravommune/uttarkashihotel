<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('order_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('INR');
            $table->string('razorpay_signature')->nullable();
            $table->enum('status', ['pending', 'successful', 'failed'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->text('error_description')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
