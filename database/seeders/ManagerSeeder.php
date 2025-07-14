<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 50 fake managers
        foreach (range(1, 50) as $index) {
            DB::table('managers')->insertOrIgnore([
                'booking_id' => $faker->unique()->numberBetween(1000, 9999),
                'guest' => $faker->name,
                'room_type' => $faker->word,
                'rooms' => $faker->numberBetween(1, 5),
                'check_in' => $faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
                'check_out' => $faker->dateTimeBetween('+1 month', '+2 months')->format('Y-m-d'),
                'price' => $faker->numberBetween(50, 500),
                'status' => $faker->randomElement(['Booked', 'Checked-In', 'Checked-Out']),
            ]);
        }
    }
}
