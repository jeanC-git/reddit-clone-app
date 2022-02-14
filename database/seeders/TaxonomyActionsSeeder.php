<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxonomyActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // GROUP : ACTIONS
        $system = [
            // THREADS ACTIONS
            [
                'group' => 'user-actions',
                'type' => 'posts',
                'position' => 1,
                'code' => 'like-post',
                'name' => 'Like Post',
                'short_name' => 'Like Post',
                'slug' => 'like-post',
                'active' => 1,
            ],
            [
                'group' => 'user-actions',
                'type' => 'posts',
                'position' => 2,
                'code' => 'dislike-post',
                'name' => 'Dislike Post',
                'short_name' => 'Dislike Post',
                'slug' => 'dislike-post',
                'active' => 1,
            ],
            // COMMENTS ACTIONS
            [
                'group' => 'user-actions',
                'type' => 'comments',
                'position' => 1,
                'code' => 'like-comment',
                'name' => 'Like Comment',
                'short_name' => 'Like Comment',
                'slug' => 'like-comment',
                'active' => 1,
            ],
            [
                'group' => 'user-actions',
                'type' => 'comments',
                'position' => 2,
                'code' => 'dislike-comment',
                'name' => 'Dislike Comment',
                'short_name' => 'Dislike Comment',
                'slug' => 'dislike-comment',
                'active' => 1,
            ],
        ];
        DB::table('taxonomies')->insert($system);
    }
}
