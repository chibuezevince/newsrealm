<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Business & Finance', 'slug' => 'business', 'color' => '#F97316'],
            ['name' => 'Cryptocurrency', 'slug' => 'cryptocurrency', 'color' => '#DC2626'],
            ['name' => 'Entertainment', 'slug' => 'entertainment', 'color' => '#7C3AED'],
            ['name' => 'Finance', 'slug' => 'finance', 'color' => '#D97706'],
            ['name' => 'Food', 'slug' => 'food', 'color' => '#84CC16'],
            ['name' => 'Game', 'slug' => 'game', 'color' => '#EC4899'],
            ['name' => 'General', 'slug' => 'general', 'color' => '#6B7280'],
            ['name' => 'Health', 'slug' => 'health', 'color' => '#10B981'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'color' => '#F472B6'],
            ['name' => 'Opinion', 'slug' => 'opinion', 'color' => '#8B5CF6'],
            ['name' => 'Politics', 'slug' => 'politics', 'color' => '#2563EB'],
            ['name' => 'Programming', 'slug' => 'programming', 'color' => '#6366F1'],
            ['name' => 'Regional', 'slug' => 'regional', 'color' => '#14B8A6'],
            ['name' => 'Science', 'slug' => 'science', 'color' => '#06B6D4'],
            ['name' => 'Sports', 'slug' => 'sports', 'color' => '#059669'],
            ['name' => 'Technology', 'slug' => 'technology', 'color' => '#6366F1'],
            ['name' => 'World', 'slug' => 'world', 'color' => '#1D4ED8'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
