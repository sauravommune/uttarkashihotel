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
        Schema::table('rate_plans', function (Blueprint $table) {
            //
            if( Schema::hasColumn('rate_plans', 'rate_list')) {
                $table->dropColumn('rate_list');
            }
            if( Schema::hasColumn('rate_plans', 'pricing_start_date')) {
                $table->dropColumn('pricing_start_date');
            }
            if( Schema::hasColumn('rate_plans', 'pricing_end_date')) {
                $table->dropColumn('pricing_end_date');
            }
            $table->date('pricing_date')->nullable()->after('weekly_rate');
            $table->string('year', 4)->nullable()->after('pricing_date')->change();
            $table->string('month', 2)->nullable()->after('year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rate_plans', function (Blueprint $table) {
            //
            $table->dropColumn('pricing_date');
            $table->string('year')->nullable()->change();
            $table->dropColumn('month');
        });
    }
};
