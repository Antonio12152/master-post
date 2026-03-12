<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = \App\Models\Post::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(6),
            'text' => $this->faker->paragraphs(2, true),
            'type' => $this->faker->randomElement(['post', 'announcement']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}