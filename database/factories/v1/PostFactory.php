<?php

namespace Database\Factories\v1;

use App\Models\v1\AppUser;
use App\Models\v1\Post;
use App\Models\v1\Taxonomy;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Post::class;

    public function definition()
    {
        return [
            'app_user_id' => AppUser::first()->id,
            'title' => ucwords($this->faker->words(4, true)),
            'text' => $this->faker->text(200),
            'category_id' => Taxonomy::group('post')->type('categories')->inRandomOrder()->first()->id,
        ];
    }
}
