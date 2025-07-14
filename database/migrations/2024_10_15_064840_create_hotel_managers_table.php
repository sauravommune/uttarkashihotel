<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_managers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ensure this line is present
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'super admin', 'manager']);
            $table->date('date_added');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('hotel_managers');
    }
}
