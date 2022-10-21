<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setor>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            // 'name' => fake()->jobTitle(),
            // 'email'=> fake()->email(),
            // 'password'=> fake()->regexify(),
            // 'ramal'=> fake()->regexify(),
            // 'tipo'=> fake()->text('Técnico' | 'Usuário'),
            // 'setores_id'=> fake()->randomDigit(),
            // 'remember_token'=> fake()->randomDigit(10),
        ];

    }
}
