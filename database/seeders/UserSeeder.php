<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'scrum_admin@yopmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Test@1234'),
            'type' => "admin",
            'can_login' => 1
        ]);


        User::create([
            'name' => 'Trainer',
            'email' => 'scrum_trainer@yopmail.com',
            'type' => 'trainer',
            'can_login' => 0
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@yopmail.com',
            'email_verified_at' => now(),
            'type' => 'participant',
            'can_login' => 0
        ]);

        User::create([
            'name' => 'Jane Adam',
            'email' => 'janeadam@yopmail.com',
            'email_verified_at' => now(),
            'type' => 'participant',
            'can_login' => 0
        ]);

    }
}
