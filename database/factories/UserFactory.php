<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->paragraphs(2, true),
            'password' => 'password',
            'type' => $this->faker->randomElement(['user', 'admin']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}