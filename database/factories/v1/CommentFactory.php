<?php

namespace Database\Factories\v1;

use App\Models\v1\AppUser;
use App\Models\v1\Comment;
use App\Models\v1\Post;
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

        return [
            'post_id' => Post::inRandomOrder()->first()->id,
            'app_user_id' => AppUser::inRandomOrder()->first(),
            'comment_id' => null,
            'likes' => random_int(1,100),
            'dislikes' => random_int(1,100),
            'text' => $this->faker->text(),
        ];
    }
}
