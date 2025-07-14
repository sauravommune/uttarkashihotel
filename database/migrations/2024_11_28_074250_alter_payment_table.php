<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Payment;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $payments = Payment::where('status', 'successful');
        $payments->update([
            'status' => 'pending'
        ]);
        Schema::table('payments', function (Blueprint $table) {
            //
            if( Schema::hasColumn('payments', 'razorpay_signature')) {
                $table->dropColumn('razorpay_signature');
            }
            $table->enum('status', ['captured','authorized','failed','refunded','pending','expired','cancelled'])->default('pending')->change();
            $table->float('gateway_fee')->default(0);
            $table->float('gateway_tax')->default(0);
            $table->float('coupon')->default(0);
            $table->float('additional_discount')->default(0);
            $table->float('cost')->default(0);
            $table->float('refund_amount')->default(0);
            $table->float('markup')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('is_initial')->default(false);
        });

        $payments->update([
            'status' => 'captured',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->string('razorpay_signature')->nullable();
            $table->dropColumn('gateway_fee');
            $table->dropColumn('gateway_tax');
            $table->dropColumn('coupon');
            $table->dropColumn('additional_discount');
            $table->dropColumn('cost');
            $table->dropColumn('refund_amount');
            $table->dropColumn('markup');
            $table->dropColumn('remarks');
            $table->dropColumn('is_initial');
        });
    }
};
