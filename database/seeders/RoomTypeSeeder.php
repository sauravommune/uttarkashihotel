<?php

namespace Database\Seeders;

use App\Models\RoomCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PDO;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = config('data.roomTypes');
        foreach($roomTypes as  $roomType){
            RoomCategory::firstOrCreate(['name' => $roomType]);
        }
    }
}
