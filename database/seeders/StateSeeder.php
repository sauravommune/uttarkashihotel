<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            "AN"    => "Andaman and Nicobar Islands",
            "AP"    => "Andhra Pradesh",
            "AR"    => "Arunachal Pradesh",
            "AS"    => "Assam",
            "BR"    => "Bihar",
            "CG"    => "Chandigarh",
            "CH"    => "Chhattisgarh",
            "DN"    => "Dadra and Nagar Haveli",
            "DD"    => "Daman and Diu",
            "DL"    => "Delhi",
            "GA"    => "Goa",
            "GJ"    => "Gujarat",
            "HR"    => "Haryana",
            "HP"    => "Himachal Pradesh",
            "JK"    => "Jammu and Kashmir",
            "JH"    => "Jharkhand",
            "KA"    => "Karnataka",
            "KL"    => "Kerala",
            "LA"    => "Ladakh",
            "LD"    => "Lakshadweep",
            "MP"    => "Madhya Pradesh",
            "MH"    => "Maharashtra",
            "MN"    => "Manipur",
            "ML"    => "Meghalaya",
            "MZ"    => "Mizoram",
            "NL"    => "Nagaland",
            "OR"    => "Odisha",
            "PY"    => "Puducherry",
            "PB"    => "Punjab",
            "RJ"    => "Rajasthan",
            "SK"    => "Sikkim",
            "TN"    => "Tamil Nadu",
            "TS"    => "Telangana",
            "TR"    => "Tripura",
            "UP"    => "Uttar Pradesh",
            "UK"    => "Uttarakhand",
            "WB"    => "West Bengal"
        ];

        foreach ($states as $key => $value) {
            State::firstOrCreate([
                'code' => $key,
                'name' => $value
            ]);
        }
    }
}
