<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = \App\Models\Comment::class;

    public function definition(): array
    {
        return [
            'post_id' => \App\Models\Post::factory(),
            'user_id' => \App\Models\User::factory(),
            'parent_id' => null,
            'text' => $this->faker->paragraph(),
            'type' => 'comment',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}