<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loja>
 */
class LojaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomeLoja' => $this->faker->words(3,true),
            'endereço' => $this->faker->words(3,true),
            'imgLoja' => $this->faker->imageUrl($width = 640, $height = 480),
            'rota' => $this->faker->url,
            'telefone' => $this->faker->phoneNumber,
        ];
    }
}
