<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $book = Book::all()->random();
        $user = User::all()->random();
        $address = Address::all()->random();
        $quantity = rand(1,2);
        $total = $book->price * $quantity;

        dump($book->id); dump($user->id);

        return [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'address_id' => $address->id,
            'nel_carrello' => (rand(1,10) % 2 == 0)? 0 : 1, 
            'quantity' =>  $quantity,
            'totalPrice' => $total,

        ];
    }
}
