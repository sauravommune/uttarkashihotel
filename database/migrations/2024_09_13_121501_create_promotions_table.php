<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('promotion_type'); 
            $table->float('discount_percent'); 
            $table->float('discount_min_price'); 
            $table->date('offer_start_date')->nullable(); 
            $table->date('offer_end_date')->nullable(); 
            $table->date('check_in_date')->nullable(); 
            $table->date('check_out_date')->nullable(); 
            $table->string('seen_by')->nullable(); 
            $table->string('applied_on')->nullable(); 
            $table->string('created_by')->nullable();
            $table->enum('status',['active','inactive','pause','expired'])->default('inactive');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
