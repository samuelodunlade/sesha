<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Secret>
 */
class SecretFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(3),
            "summary" => fake()->sentence(10),
            //category_id should random category id from category table that is active
            "category_id" => \App\Models\Category::where('status', 'active')->inRandomOrder()->first()->id,
            "content" => fake()->paragraph(10),
            "expires_at" => now()->addDays(1),
            "slug" => \Illuminate\Support\Str::slug(fake()->sentence(3)).'-'.uniqid(),
            "ip_address" => fake()->ipv4()
        ];
    }
}
