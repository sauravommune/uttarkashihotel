<?php

use App\Models\Booking;
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
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Booking::class)->nullable();
            $table->text('remarks')->nullable();
            $table->dateTime('follow_up_date')->nullable();
            $table->unsignedBigInteger('follow_up_by')->nullable();
            $table->enum('status', ['Open', 'Closed'])->default('Open');
            $table->foreign('follow_up_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
    }
};
