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
        Schema::table('contact_information', function (Blueprint $table) {
            //
            $table->boolean('is_gst_opted')->default(0)->after('city_name');
            $table->string('gst_number')->nullable()->after('is_gst_opted');
            $table->string('company_name')->nullable()->after('gst_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_information', function (Blueprint $table) {
            //
            $table->dropColumn('is_gst_opted');
            $table->dropColumn('gst_number');
            $table->dropColumn('company_name');
        });
    }
};
