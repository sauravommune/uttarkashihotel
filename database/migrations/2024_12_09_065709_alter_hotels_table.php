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
        Schema::table('hotels', function (Blueprint $table) {
            $table->unsignedBigInteger('city')->change();
            $table->string('google_place_id')->nullable()->after('city');
            $table->string('google_place_text')->nullable()->after('google_place_id');
            $table->foreign('city')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('google_place_id');
            $table->dropColumn('google_place_text');
            $table->dropForeign(['city']);
        });
    }
};
