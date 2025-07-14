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
        Schema::table('cities', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('state_id')->nullable()->after('name');
            $table->string('meta_title', 100)->nullable()->after('state_id');
            $table->string('meta_description')->nullable()->after('meta_title');

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            //
            $table->dropForeign(['state_id']);
            $table->dropColumn(['state_id', 'meta_title', 'meta_description']);
        });
    }
};
