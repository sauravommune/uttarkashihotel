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
        Schema::table('booked_room_details', function (Blueprint $table) {
            //
            $table->float('total_price')->default(0)->after('break_fast_type')->change();
            $table->float('vendor_cost')->default(0)->after('total_price');
            $table->float('markup')->default(0)->after('vendor_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booked_room_details', function (Blueprint $table) {
            //
            $table->dropColumn(['vendor_cost', 'markup']);
        });
    }
};
