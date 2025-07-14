<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call([
            AmenitySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            ManagerSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RoleWisePermission::class,
            BreakfastSeeder::class,
            HotelManagerSeeder::class,
            RoomTypeSeeder::class,
            MetaSettingsSeeder::class
        ]);
        if( !User::where('email','santosh.singh@ommune.com')->exists() ){     
            $user= User::factory()->create([
                'name' => 'Santosh Singh',
                'email' => 'santosh.singh@ommune.com',
                'password'=>'Haint#1984'
            ]);
            $permissions = Permission::all();
            $user->assignRole('Super Admin');
            $user->syncPermissions($permissions);
        }
    }
}