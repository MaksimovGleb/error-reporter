<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ErrorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'level' => fake()->randomElement(['info', 'warning', 'error', 'critical']),
            'user_id' => User::factory(),
        ];
    }
}
