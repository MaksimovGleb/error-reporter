<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ErrorMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ErrorMessageFactory extends Factory
{
    protected $model = ErrorMessage::class;

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
