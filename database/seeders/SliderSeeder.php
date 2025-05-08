<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::create([
            'title' => 'Welcome to Our Platform',
            'top_button_text' => 'Learn More',
            'description' => 'Discover high-quality training and resources for your career growth.',
            'image' => 'sliders/default-banner.jpg',
            'main_button_text' => 'Get Started',
            'main_button_link' => '/courses',
            'status' => 1,
        ]);
    }
}
