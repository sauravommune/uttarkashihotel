<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('Booking_ID');
            $table->string('Guest_name');
            $table->string('room_type');
            $table->string('room');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('Stay_nights'); // Use integer for the number of nights
            $table->date('Booked_on');
            $table->string('Booked_status');
            $table->decimal('price', 8, 2); // Adjust precision and scale as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
