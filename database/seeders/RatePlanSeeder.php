<?php

namespace Database\Seeders;

use App\Models\RatePlan;
use App\Models\Hotel; // Import the Hotel model
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RatePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Common room types and cities
        $roomTypes = ['Standard AC Room', 'Deluxe Room', 'Suite Room'];
        $cities = ['Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Pune'];

        for ($i = 0; $i < 50; $i++) {
            // Get a random hotel
            $hotel = Hotel::inRandomOrder()->first(); // Fetch a random hotel

            // Check if a hotel was found
            if ($hotel) {
                RatePlan::create([
                    'hotel_id' => $hotel->id, // Associate the hotel with the rate plan
                    'room_type' => $faker->randomElement($roomTypes),
                    'city' => $faker->randomElement($cities),
                    'b2b_rate_ep' => $faker->numberBetween(3000, 3500),
                    'b2b_rate_cp' => $faker->numberBetween(3500, 4000),
                    'b2b_rate_map' => $faker->numberBetween(4000, 4500),
                    'markup_ep' => 1000,
                    'markup_cp' => 1000,
                    'markup_map' => 1000,
                    'total_amount_ep' => $faker->numberBetween(4200, 4800),
                    'total_amount_cp' => $faker->numberBetween(4700, 5300),
                    'total_amount_map' => $faker->numberBetween(5500, 6000),
                    'pricing_start_date' => $faker->dateTimeBetween('2024-02-01', '2024-02-10'),
                    'pricing_end_date' => $faker->dateTimeBetween('2024-04-01', '2024-04-10'),
                    'created_on' => now(),
                    'margin_updated_on' => now(),
                ]);
            } else {
                // Handle the case where no hotel is found
                // You can log this situation or throw an exception if needed
                \Log::warning('No hotel found to associate with RatePlan. Skipping...');
            }
        }
    }
}
