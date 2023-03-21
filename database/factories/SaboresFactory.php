<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sabores>
 */
class SaboresFactory extends Factory
{
   
    public function definition(): array
    {
        return [
            'nome' => $this->faker->words(3,true),
            'descricao' => $this->faker->words(3,true),
            'imagem' => $this->faker->words(3,true),
            'sorvete_id' => $this->faker->randomDigitNot(2),

        ];
    }

    
}
