<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ankit Verma',
                'email' => 'ankit.verma@ommune.in',
                'password'=>'Laint#1984'
            ],
            [
                'name' => 'Saurav',
                'email' => 'saurav@ommune.in',
                'password'=>'git st'
            ],
        ];

       foreach($users as $user){
            $user1 = User::firstOrCreate($user);
            $user1->assignRole('User');
       }
    }
}
