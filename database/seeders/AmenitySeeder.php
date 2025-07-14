<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
           'general_amenities'=>[
                'Clothes Rack',
                'Linen',
                'Room Service',
                'Safety deposit box',
                'Flat-screen TV',
                'Desk',
                'Towels',
                'Wardrobe and closet',
                'Air Conditioner',
                'Wake-up Service',
                'Heating'
            ],
            'outdoor_views'=>[
                'Balcony',
                'Terrace',
                'Pool facing'
            ],
            'food_and_drinks'=>[
                'Electric Kettle',
                'Microwave',
                'Tea/Coffee maker',
                'Kitchen area'
            ]
        ];

        foreach ($amenities as $type => $amenity) {
            foreach($amenity as $item ){
                Amenity::firstOrCreate(['name' => $item,'amenity_type'=>$type,'type'=>'room']);
            }
        }
    }
}