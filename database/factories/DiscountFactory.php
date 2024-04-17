<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name_disocunts = [
            'Sconti Primavera', 
            'Sconti Assalto',
            'Sconti Per Te',

            
            // Aggiungi altre categorie qui se necessario
        ];
        return [
            'name' => $this->faker->unique()->randomElement($name_disocunts),
            'percent' => rand(5,80)
        ];
    }
}
