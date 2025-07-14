<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HotelManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for hotel managers
        $managers = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'role' => 'admin',
                'date_added' => Carbon::now()->toDateString(),
                'is_active' => true,
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'role' => 'super admin',
                'date_added' => Carbon::now()->toDateString(),
                'is_active' => true,
            ],
            [
                'name' => 'Mark Johnson',
                'email' => 'mark@example.com',
                'role' => 'manager',
                'date_added' => Carbon::now()->toDateString(),
                'is_active' => false,
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily@example.com',
                'role' => 'admin',
                'date_added' => Carbon::now()->toDateString(),
                'is_active' => true,
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'role' => 'manager',
                'date_added' => Carbon::now()->toDateString(),
                'is_active' => true,
            ],
        ];

        // Insert the sample data into the hotel_managers table
        DB::table('hotel_managers')->insertOrIgnore($managers);
    }
}
