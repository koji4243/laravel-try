<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; 

class UserFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'juusyo' => fake()->address(),
            'tell' => fake()->phoneNumber(),
            'category_id' => fake()->numberBetween(1, 6)

        ];
    }
}
