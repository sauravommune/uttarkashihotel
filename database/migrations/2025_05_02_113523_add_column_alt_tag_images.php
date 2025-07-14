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
        Schema::table('images', function (Blueprint $table) {
            
            $table->string('image_name')->nullable()->after('image');
            $table->string('alt_tag')->nullable()->after('image');

        });
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('image_name')->nullable()->after('hotel_imgs');
            $table->string('alt_tag')->nullable()->after('hotel_imgs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('image_name');
            $table->dropColumn('alt_tag');
        });
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('image_name');
            $table->dropColumn('alt_tag');
        });
    }
};
