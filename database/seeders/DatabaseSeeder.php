<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(15)->create();

        $users->each(function ($user) use ($users) {

            $posts = Post::factory(rand(1, 15))->for($user)->create();

            $posts->each(function ($post) use ($users) {

                $comments = Comment::factory(rand(3, 8))
                    ->for($post)
                    ->for($users->random())
                    ->create();

                $comments->each(function ($comment) use ($users, $post) {

                    $users->random(rand(1, 4))->each(function ($user_sub) use ($comment, $post) {

                        Comment::factory()
                            ->for($post)
                            ->for($user_sub)
                            ->create([
                                'parent_id' => $comment->id
                            ]);
                    });
                });
            });
        });
    }
}
