<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditCard>
 */
class CreditCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user =  User::all()->random();
        dump($user->id);
        return [
            
            'user_id' => $user->id,
            'name' => $user->name,
            'number' => $this->faker->creditCardNumber,
            'cvv' => rand(100,9999),
            'expiration'=> $this->faker->creditCardExpirationDate,
            'usate' => $this->faker->dateTimeBetween('- 1 week', '-1 day'),
        ];
    }
}
