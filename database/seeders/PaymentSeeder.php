<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Payment::create([
        //     'amount_paid' => 100.00,
        //     'amount_due' => 0.00,
        //     'status' => 'Paid',
        //     'payment_date' => now(),
        //     'mode' => 'Credit Card',
        // ]);

        // Payment::create([
        //     'amount_paid' => 50.00,
        //     'amount_due' => 50.00,
        //     'status' => 'Pending',
        //     'payment_date' => now()->subDays(2),
        //     'mode' => 'Bank Transfer',
        // ]);

        // Payment::create([
        //     'amount_paid' => 0.00,
        //     'amount_due' => 150.00,
        //     'status' => 'Failed',
        //     'payment_date' => now()->subDays(5),
        //     'mode' => 'PayPal',
        // ]);

        // Payment::create([
        //     'amount_paid' => 75.00,
        //     'amount_due' => 25.00,
        //     'status' => 'Partially Paid',
        //     'payment_date' => now()->subDays(3),
        //     'mode' => 'Credit Card',
        // ]);

        // Payment::create([
        //     'amount_paid' => 200.00,
        //     'amount_due' => 0.00,
        //     'status' => 'Paid',
        //     'payment_date' => now()->subDays(1),
        //     'mode' => 'Debit Card',
        // ]);
    }
}
