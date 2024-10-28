<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $blogs = [];

        for ($i = 0; $i < 1000; $i++) {
            $title = $faker->sentence(6, true);
            $blogs[] = [
                'title' => $title,
                'slug' => \Str::slug($title) . '-' . $i, // Ensure unique slug
                'category' => $faker->randomElement(['Technology', 'Science', 'AI', 'Nature', 'Environment', 'Sports','Fashion','Design','LifeStyle','Travel','Journey']),
                'short_description' => $faker->text(100),
                'description' => $faker->text(500),
                'blog_image' => $faker->imageUrl(640, 480, 'blog', true, 'Faker'),
                'tags' => implode(', ', $faker->words(5)),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the data into the database
        Blog::insert($blogs);
    }
}
