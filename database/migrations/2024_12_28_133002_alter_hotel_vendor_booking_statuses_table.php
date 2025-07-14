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
        Schema::table('hotel_vendor_booking_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('confirmed_by')->nullable()->after('status');
            $table->foreign('confirmed_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_vendor_booking_statuses', function (Blueprint $table) {
            $table->dropForeign(['confirmed_by']);
            $table->dropColumn('confirmed_by');
        });
    }
};
