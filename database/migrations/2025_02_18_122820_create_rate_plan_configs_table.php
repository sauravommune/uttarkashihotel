<?php

use App\Models\RatePlan;
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
        Schema::create('rate_plan_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RatePlan::class);
            $table->enum('plan_type', ['ep','cp','map','ap']);

            $table->integer('extra_person_price')->default(0);
            $table->integer('extra_person_markup')->default(0);

            $table->integer('child_with_bed_price')->default(0);
            $table->integer('child_with_bed_markup')->default(0);

            $table->integer('child_with_no_bed_price')->default(0);
            $table->integer('child_with_no_bed_markup')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_plan_configs');
    }
};
