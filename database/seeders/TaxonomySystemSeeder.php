<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxonomySystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // GROUP : SYSTEM
        $system = [
            [
                'group' => 'system',
                'type' => 'platform',
                'position' => 1,
                'code' => 'gestor',
                'name' => 'Gestor',
                'short_name' => 'Gestor',
                'slug' => 'gestor',
                'active' => 1,
            ],
            [
                'group' => 'system',
                'type' => 'platform',
                'position' => 2,
                'code' => 'user',
                'name' => 'User App',
                'short_name' => 'User App',
                'slug' => 'user-app',
                'active' => 1,
            ],
        ];
        DB::table('taxonomies')->insert($system);
    }
}
