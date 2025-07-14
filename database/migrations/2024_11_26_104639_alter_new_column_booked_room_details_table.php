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
        //


        Schema::table('booked_room_details', function (Blueprint $table) {

            $table->dropForeign(['rate_plan']); // Remove foreign key constraint
            $table->dropColumn('rate_plan');    // Delete the column
            
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
