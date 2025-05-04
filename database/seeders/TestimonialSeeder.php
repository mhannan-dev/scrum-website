<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all users
        $users = User::get();

        foreach ($users as $user) {
            Testimonial::create([
                'user_id' => $user->id,
                'comment' => 'This course helped me improve my skills in a short amount of time!',
                'image' => 'testimonials/john_image.jpg',
                'designation' => 'Software Developer',
            ]);
        }
    }
}
