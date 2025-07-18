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
        if (!Schema::hasTable('company_masters')) {
            Schema::create('company_masters', function (Blueprint $table) {
                $table->id();
                $table->string('company_name');
                $table->string('contact_person');
                $table->string('contact_email');
                $table->string('contact_phone');
                $table->integer('enable_for_trade')->default('1')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_masters');
    }
};
