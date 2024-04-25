<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       //$user = User::inRandomOrder()->
        return [
            'user_id' => User::all()->random()->id,
            'user_address' => $this->faker->address,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode, // Aggiungi codice postale
            'country' => $this->faker->country, // Aggiungi il paese
            'telephone' => $this->faker->phoneNumber, // Aggiungi telefono
            'mobile' => $this->faker->phoneNumber, // Aggiungi cellulare
        
        ];
    }
}
