<?php

namespace Database\Factories;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Import the Str class

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name(); // Generate the author's name
        return [
            
            'name' => $name,
            'slug' => Str::slug($name),
            // 'slug'=> fake()->unique()->slug(),
            // 'image'=>fake()->imageUrl(640, 480, 'people', true),
        ];
    }
}
