<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            ['name' => 'HDFC Bank', 'code' => 'hdfc', 'status' => true],
            ['name' => 'ICICI Bank', 'code' => 'icici', 'status' => true],
            ['name' => 'State Bank of India', 'code' => 'sbi', 'status' => true],
            ['name' => 'Axis Bank', 'code' => 'axis', 'status' => true],
            ['name' => 'Punjab National Bank', 'code' => 'pnb', 'status' => true],
            ['name' => 'Kotak Mahindra Bank', 'code' => 'kotak', 'status' => true],
            ['name' => 'Bank of Baroda', 'code' => 'bob', 'status' => true],
            ['name' => 'Yes Bank', 'code' => 'yes', 'status' => true],
            ['name' => 'Canara Bank', 'code' => 'canara', 'status' => true],
            ['name' => 'IndusInd Bank', 'code' => 'indusind', 'status' => true],
            ['name' => 'Union Bank of India', 'code' => 'ubi', 'status' => true],
            ['name' => 'Central Bank of India', 'code' => 'cbi', 'status' => true],
            ['name' => 'Bank of India', 'code' => 'boi', 'status' => true],
            ['name' => 'Indian Bank', 'code' => 'ib', 'status' => true],
            ['name' => 'Ratnakar Bank Ltd', 'code' => 'rbl', 'status' => true],
            ['name' => 'IDBI Bank', 'code' => 'idbi', 'status' => true],
            ['name' => 'DBS Bank', 'code' => 'dbs', 'status' => true],
            ['name' => 'Federal Bank', 'code' => 'federal', 'status' => true],
            ['name' => 'South Indian Bank', 'code' => 'sib', 'status' => true],
            ['name' => 'UCO Bank', 'code' => 'uco', 'status' => true],
            ['name' => 'Dhanlaxmi Bank', 'code' => 'dhanlaxmi', 'status' => true],
            ['name' => 'IDFC First Bank', 'code' => 'idfc', 'status' => true],
            ['name' => 'Syndicate Bank', 'code' => 'syndicate', 'status' => true],
            ['name' => 'Allahabad Bank', 'code' => 'allahabad', 'status' => true],
            ['name' => 'Corporation Bank', 'code' => 'corporation', 'status' => true],
            ['name' => 'Oriental Bank of Commerce', 'code' => 'obc', 'status' => true],
            ['name' => 'Karur Vysya Bank', 'code' => 'karurvysya', 'status' => true],
            ['name' => 'Tamilnad Mercantile Bank', 'code' => 'tmb', 'status' => true],
            ['name' => 'Lakshmi Vilas Bank', 'code' => 'lvb', 'status' => true],
            ['name' => 'Jammu and Kashmir Bank', 'code' => 'jkbank', 'status' => true],
            ['name' => 'Nainital Bank', 'code' => 'nainital', 'status' => true],
            ['name' => 'Bandhan Bank', 'code' => 'bandhan', 'status' => true],
            ['name' => 'Equitas Small Finance Bank', 'code' => 'equitas', 'status' => true],
            ['name' => 'AU Small Finance Bank', 'code' => 'au', 'status' => true],
            ['name' => 'ESAF Small Finance Bank', 'code' => 'esaf', 'status' => true],
            ['name' => 'Utkarsh Small Finance Bank', 'code' => 'utkarsh', 'status' => true],
            ['name' => 'Fincare Small Finance Bank', 'code' => 'fincare', 'status' => true],
            ['name' => 'Suryoday Small Finance Bank', 'code' => 'suryoday', 'status' => true],
            ['name' => 'Ujjivan Small Finance Bank', 'code' => 'ujjivan', 'status' => true],
            ['name' => 'Capital Small Finance Bank', 'code' => 'capital', 'status' => true],
            ['name' => 'Paytm Payments Bank', 'code' => 'paytm', 'status' => true],
            ['name' => 'Airtel Payments Bank', 'code' => 'airtel', 'status' => true],
            ['name' => 'India Post Payments Bank', 'code' => 'ippb', 'status' => true],
        ];

        DB::table('banks')->insert($banks);
    }
}
