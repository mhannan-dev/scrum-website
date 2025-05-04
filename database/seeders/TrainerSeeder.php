<?php

namespace Database\Seeders;

use App\Models\User as Trainer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example trainer data
        $trainers = [
            [
                'name' => 'John Doe',
                'type' => 'trainer',
                'email' => 'johndoe@yopmail.com', // Email based on the name
                'slug' => Str::slug('John Doe') . '-' . now()->timestamp,
                'social_links' => json_encode([
                    'facebook' => 'https://facebook.com/johndoe',
                    'twitter' => 'https://twitter.com/johndoe'
                ]),
                'category_id' => 1, // assuming category with id 1 exists
                'can_login' => 0
            ],
            [
                'name' => 'Jane Smith',
                'type' => 'trainer',
                'email' => 'janesmith@yopmail.com', // Email based on the name
                'slug' => Str::slug('Jane Smith') . '-' . now()->timestamp,
                'social_links' => json_encode([
                    'linkedin' => 'https://linkedin.com/in/janesmith',
                    'instagram' => 'https://instagram.com/janesmith'
                ]),
                'category_id' => 2, // assuming category with id 2 exists
                'can_login' => 0
            ],
            [
                'name' => 'Alice Johnson',
                'type' => 'trainer',
                'email' => 'alicejohnson@yopmail.com', // Email based on the name
                'slug' => Str::slug('Alice Johnson') . '-' . now()->timestamp,
                'social_links' => json_encode([
                    'linkedin' => 'https://linkedin.com/in/alicejohnson'
                ]),
                'category_id' => null, // no category
                'can_login' => 0
            ]
        ];

        // Insert the trainers into the database
        foreach ($trainers as $trainer) {
            Trainer::create($trainer);
        }
    }
}
