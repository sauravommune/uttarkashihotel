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
            $table->text('embed_map_url')->nullable();
            $table->integer('papular')->default(0)->comment('1 is papular; 0 is none');
            $table->integer('recommended')->default(0)->comment('1 is recommended; 0 is none');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {

            $table->dropColumn('embed_map_url');
            $table->dropColumn('papular');
            $table->dropColumn('recommended');

        });
       
    }
};
