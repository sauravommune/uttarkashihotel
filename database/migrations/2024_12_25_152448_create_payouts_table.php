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
        $ref_table = config('referral.referral_table', 'users');
        Schema::create('payouts', function (Blueprint $table) use ($ref_table) {
            $table->id();
            $table->foreignId('user_id')->constrained($ref_table)->onDelete('cascade');
            $table->double('amount')->default(0);
            $table->string('transaction_id')->nullable();
            $table->date('paid_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
