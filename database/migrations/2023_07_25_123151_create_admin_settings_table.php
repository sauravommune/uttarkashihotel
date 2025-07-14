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
        if (!Schema::hasTable('admin_settings')) {
            Schema::create('admin_settings', function (Blueprint $table) {
                $table->id();
                $table->string('sac_code')->nullable();
                $table->string('sac_text')->default('SAC Code')->nullable();
                $table->integer('show_sac')->default('0')->nullable();
                $table->json('invoice_settings')->nullable();
                $table->json('payment_gateways')->nullable();
                $table->json('email_settings')->nullable();
                $table->string('stemp_image')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_settings');
    }
};
