<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'full_name' => 'John Doe',
                'username' => 'john.doe',
                'password' => bcrypt('password')
            ]
        ];

        foreach($user as $key => $val) {
            User::create($val);
        }    
    }
}
