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
        Schema::table('recommend_hotels', function (Blueprint $table) {
            //
            $table->tinyInteger('is_mail')->default(0)->comment('1 is send ;0 is none')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recommend_hotels', function (Blueprint $table) {
            //
            $table->dropColumn('is_mail');
        });
    }
};
