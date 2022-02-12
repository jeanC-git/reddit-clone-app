<?php

namespace Database\Seeders;

use App\Models\v1\Comment;
use App\Models\v1\Thread;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AppUsersSeeder::class,
            TaxonomySystemSeeder::class,
            TaxonomyActionsSeeder::class,
        ]);

//        AppUser::factory(20)->create();
        Thread::factory(20)->create();
        Comment::factory(200)->create();
    }
}
