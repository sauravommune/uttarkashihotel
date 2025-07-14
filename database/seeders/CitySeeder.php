<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = State::where('name','Uttar Pradesh')->first();
        $cities = [
            ['name' =>'Varanasi', 'state_id' => $state->id],
            ['name' => 'Ayodhya', 'state_id' => $state->id],
        ];
        foreach($cities as $city){
            City::updateOrCreate(
                [
                    'name' => $city['name'],
                ],
                [
                    'state_id' => $city['state_id']
                ]
            );
        }
    }
}
