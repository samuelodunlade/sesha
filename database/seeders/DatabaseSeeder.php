<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $categories = ['Dating', 'Relationship', 'Life Lessons', 'Funny Stories', 'Travel Stories', 'Food Stories', 'Pet Stories', 'Hobbies and Interests', 'School Memories', 'Childhood Memories', 'Health and Wellness', 'Personal Growth'];

        // foreach ($categories as $key => $value) {
        //     $slug = strtolower(str_replace(" ", "-", $value)."-".uniqid(5, true));
        //     Category::create([
        //         "title" => $value,
        //         "slug" => $slug
        //     ]);
            
        // }

        //call the secret factory
        \App\Models\Secret::factory(100)->create();


        
    }
}
