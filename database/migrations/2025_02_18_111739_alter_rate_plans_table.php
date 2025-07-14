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
        Schema::table('rate_plans', function (Blueprint $table) {
            $table->boolean('is_extra_person_allowed')->default(0)->after('availability');
            $table->integer('no_of_extra_person')->default(0)->after('is_extra_person_allowed');

            $table->boolean('child_with_bed')->default(0)->after('no_of_extra_person');
            $table->integer('min_child_age')->default(0)->after('child_with_bed');

            $table->boolean('child_with_no_bed')->default(0)->after('min_child_age');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rate_plans', function (Blueprint $table) {
            //
            $table->dropColumn(['is_extra_person_allowed', 'no_of_extra_person', 'child_with_bed', 'min_child_age', 'child_with_no_bed']);
        });
    }
};
