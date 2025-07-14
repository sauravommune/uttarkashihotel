<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Hotel;
use App\Models\Campaign;

class CampaignSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Common campaign titles
        $campaignTitles = [
            'Summer Sale',
            'Winter Discounts',
            'Festive Offers',
            'Midweek Special',
            'Weekend Getaway',
        ];

        for ($i = 0; $i < 50; $i++) {
            // Get a random hotel
            $hotel = Hotel::inRandomOrder()->first(); // Fetch a random hotel

            // Check if a hotel was found
            if ($hotel) {
                Campaign::create([
                    'hotel_id' => $hotel->id, // Associate the campaign with the hotel
                    'title' => $faker->randomElement($campaignTitles),
                    'description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
                    'start_date' => $faker->dateTimeBetween('2024-01-01', '2024-06-01'),
                    'end_date' => $faker->dateTimeBetween('2024-06-02', '2024-12-31'),
                    'created_by' => $faker->randomElement(['admin', 'Hotel Manager']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Handle the case where no hotel is found
                \Log::warning('No hotel found to associate with Campaign. Skipping...');
            }
        }
    }
}

