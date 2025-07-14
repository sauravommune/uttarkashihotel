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
        Schema::create('google_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('gmail_api');
            $table->text('client_id')->nullable();
            $table->text('client_secret')->nullable();
            $table->text('redirect_uri')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_credentials');
    }
};
