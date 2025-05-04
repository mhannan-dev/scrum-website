<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Parent category
        $scrum = Category::create([
            'title' => 'Scrum Training',
            'slug' => Str::slug('Scrum Training'),
            'meta_title' => 'Scrum Training Courses',
            'meta_description' => 'Learn Scrum fundamentals, roles, and implementation best practices.',
            'status' => true,
            'parent_id' => null,
        ]);

        // Child categories
        $subcategories = [
            'Scrum Fundamentals',
            'Scrum Master Training',
            'Product Owner Training',
            'Agile Principles',
            'Sprint Planning & Execution',
            'Scrum Certification Prep'
        ];

        foreach ($subcategories as $title) {
            Category::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'meta_title' => $title,
                'meta_description' => "Learn more about $title.",
                'status' => true,
                'parent_id' => $scrum->id,
            ]);
        }
    }
}
