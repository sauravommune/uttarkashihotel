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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable(); // Description column added
            $table->date('booking_start_date')->nullable();
            $table->date('booking_end_date')->nullable();
            $table->date('stay_start_date')->nullable();
            $table->date('stay_end_date')->nullable();
            $table->string('seen_by')->nullable();
            $table->string('applies_on')->nullable();
            $table->string('created_by')->nullable(); // Allow null values
            $table->integer('total_bookings')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns'); // Drop the campaigns table on rollback
    }
};
