<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER before_insert_booking_lead
            BEFORE INSERT ON bookings
            FOR EACH ROW
            BEGIN
                DECLARE last_booking_id VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
                DECLARE last_id_number INT;
                DECLARE new_id_number INT;
                DECLARE new_booking_id VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
                DECLARE prefix CHAR(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT \'BKG\';

                -- Get the last booking_id from the table
                SELECT booking_id
                INTO last_booking_id
                FROM bookings
                ORDER BY id DESC
                LIMIT 1;

                -- Check if last_booking_id is NULL (for the first record)
                IF last_booking_id IS NULL THEN
                    SET new_booking_id = CONCAT(prefix, LPAD(1, 7, \'0\'));
                ELSE
                    -- Extract the numeric part from the last booking_id
                    SET last_id_number = CAST(SUBSTRING(last_booking_id, 4) AS UNSIGNED);

                    -- Increment the numeric part
                    SET new_id_number = last_id_number + 1;

                    -- Generate new booking_id
                    SET new_booking_id = CONCAT(prefix, LPAD(new_id_number, 7, \'0\'));

                    -- Loop to ensure uniqueness of the generated booking_id
                    WHILE EXISTS (
                        SELECT 1 
                        FROM bookings 
                        WHERE booking_id = new_booking_id COLLATE utf8mb4_unicode_ci
                    ) DO
                        SET new_id_number = new_id_number + 1;
                        SET new_booking_id = CONCAT(prefix, LPAD(new_id_number, 7, \'0\'));
                    END WHILE;
                END IF;

                -- Set the new booking_id for the inserted row
                SET NEW.booking_id = new_booking_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            DB::unprepared('DROP TRIGGER IF EXISTS before_insert_booking_lead;');
        });
    }
};