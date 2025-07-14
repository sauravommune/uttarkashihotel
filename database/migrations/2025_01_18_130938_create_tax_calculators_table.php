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
        Schema::create('tax_calculators', function (Blueprint $table) {
            $table->id();
            $table->float('client_payment')->default(0);
            $table->float('vendor_payment')->default(0);
            $table->float('markup')->default(0);
            $table->float('markup_gst')->default(0);
            $table->float('gross_profit')->default(0);
            $table->float('income_tax')->default(0);
            $table->float('net_profit')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_calculators');
    }
};
