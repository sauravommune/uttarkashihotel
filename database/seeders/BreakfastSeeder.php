<?php

namespace Database\Seeders;

use App\Models\Breakfast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BreakfastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Breakfast::count() <= 0) {
            $breakfasts = [
                ['breakfast' => 'Indian', 'rate' => 500],
                ['breakfast' => 'Chinese', 'rate' => 100],
                ['breakfast' => 'Japanese', 'rate' => 700],
            ];
        
            foreach ($breakfasts as $breakfast) {
                if (!Breakfast::where('breakfast', $breakfast['breakfast'])->exists()) {
                    Breakfast::create($breakfast);
                }
            }
        }
        
    }
}
