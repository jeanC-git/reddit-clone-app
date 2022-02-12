<?php

namespace Database\Factories\v1;

use App\Models\v1\AppUser;
use App\Models\v1\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Thread::class;

    public function definition()
    {
        return [
            'app_user_id' => AppUser::first()->id,
            'title' => ucwords($this->faker->words(4, true)),
            'text' => $this->faker->paragraph(5),
        ];
    }
}
