<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$yFSZxg.O/3lmsZBpN5B/QOcft6DGE2txfE.QSojU/Ih4nYfjNYVYu', // password
            'remember_token' => Str::random(10),
            'status' => 1,
        ];
    }

}
