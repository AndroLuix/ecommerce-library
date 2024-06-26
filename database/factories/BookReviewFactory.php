<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $bookId = Book::factory()->create();
        $userId = User::factory()->create();
        

        dump($userId->id);
        dump($bookId->id);
        return [
            'book_id' => $bookId->id,
            'client_id' => $userId->id,
            'review_text' => $this->faker->text(),
            'rating' => $this->faker->numberBetween(1, 5),
            'created_at' => $this->faker->dateTimeBetween('-10 months', 'now'),
        ];
    }
}
