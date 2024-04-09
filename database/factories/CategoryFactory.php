<?php 
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Storia', 
            'Bambini', 
            'Matematica', 
            'Fantascienza', 
            'Romanzo', 
            'Biografia',
            'Arte',
            'Cucina',
            'Sport',
            'Viaggi',
            'Informatica',
            'Politica',
            'Psicologia',
            'Fotografia',
            'Musica',
            'Scienza',
            'Economia',
            'Avventura',
            'Saggistica',
            'Religione',
            'Giallo',
            // Aggiungi altre categorie qui se necessario
        ];
      

        return [
           
            'name' => $this->faker->unique()->randomElement($categories)
           
        ];

    }
}
