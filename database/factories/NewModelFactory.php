<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\NewModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewModel>
 */
class NewModelFactory extends Factory
{
    protected $model = NewModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence,
            'contenu' => $this->faker->paragraph,
            'date_debut' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'date_expiration' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
            'category_id' => $this->faker->numberBetween(1, 20)
        ];
    }
}
