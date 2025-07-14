<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->unique();
            $table->string('guest_name');
            $table->string('hotel');
            $table->string('city');
            $table->string('payment_id')->unique();
            $table->date('payment_date');
            $table->string('mode');
            $table->decimal('pcbh', 10, 2);
            $table->decimal('mkup', 10, 2);
            $table->decimal('gctp', 10, 2);
            $table->decimal('rzp_fee', 10, 2);
            $table->decimal('total', 10, 2);
            $table->enum('pmnt', ['AUTH', 'CAPT', 'REFN']);
            $table->enum('wrk', ['Completed', 'Processing', 'Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
