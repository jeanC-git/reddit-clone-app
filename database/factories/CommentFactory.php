<?php

namespace Database\Factories;

use App\Models\v1\AppUser;
use App\Models\v1\Comment;
use App\Models\v1\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Comment::class;

    public function definition()
    {
//        $comments = Comment::all()->pluck('id')->toArray();
//        $comments[] = null;

        return [
            'thread_id' => Thread::inRandomOrder()->first()->id,
            'app_user_id' => AppUser::inRandomOrder()->first(),
//            'comment_id' => array_rand($comments) === 0 ? null : array_rand($comments),
            'comment_id' => null,
            'likes' => random_int(1,100),
            'dislikes' => random_int(1,100),
            'text' => $this->faker->text(),
        ];
    }
}
