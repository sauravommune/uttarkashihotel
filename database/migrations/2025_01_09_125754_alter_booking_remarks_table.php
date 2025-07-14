<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('booking_remarks', function (Blueprint $table) {
            // Modify the `booking_id` column (if it exists) to make it nullable and add a foreign key
            if (Schema::hasColumn('booking_remarks', 'booking_id')) {
                
                $foreignKeyExists = DB::select("
                    SELECT CONSTRAINT_NAME 
                    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
                    WHERE TABLE_NAME = 'booking_remarks' 
                    AND TABLE_SCHEMA = DATABASE() 
                    AND COLUMN_NAME = 'booking_id'
                ");

                // Drop the foreign key if it exists
                if (!empty($foreignKeyExists)) {
                    $table->dropForeign(['booking_id']);
                }
                
                $table->unsignedBigInteger('booking_id')->nullable()->after('id')->change();
            } else {
                $table->unsignedBigInteger('booking_id')->nullable()->after('id');
            }

            // Add the foreign key constraint for `booking_id`
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');

            // Add the new `changes` column
            $table->json('changes')->nullable()->after('booking_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_remarks', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
            $table->dropColumn('changes');
            $table->unsignedBigInteger('booking_id')->nullable(false)->change();
        });
    }
};
