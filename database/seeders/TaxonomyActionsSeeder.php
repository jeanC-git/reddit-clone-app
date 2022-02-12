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
                'type' => 'threads',
                'position' => 1,
                'code' => 'like-thread',
                'name' => 'Like Thread',
                'short_name' => 'Like Thread',
                'slug' => 'like-thread',
                'active' => 1,
            ],
            [
                'group' => 'user-actions',
                'type' => 'threads',
                'position' => 2,
                'code' => 'dislike-thread',
                'name' => 'Dislike Thread',
                'short_name' => 'Dislike Thread',
                'slug' => 'dislike-thread',
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
