<?php

namespace Database\Factories;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'author_id' => 1,
            'title' => fake()->sentence(3),
            'publication_date' => fake()->date(),
            // 'cover_image' => fake()->imageUrl(640, 480, 'books', true),
            // 'book_file' => fake()->filePath(),
            'author_id' => Author::factory(),
        ];
    }
}
