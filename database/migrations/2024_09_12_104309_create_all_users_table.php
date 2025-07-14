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
        Schema::create('all_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->date('joining_date')->nullable();
            $table->string('role'); // Role of the user, e.g., admin, user
            $table->boolean('status')->default(1); // Status: enabled (1) or disabled (0)
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_users', function (Blueprint $table) {
            $table->dropColumn('joining_date');
        });
    }
};
