<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxonomyPostCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $system = [
            // Post categories
            [
                'group' => 'post',
                'type' => 'categories',
                'position' => 1,
                'code' => 'tecnologia',
                'name' => 'Tecnología',
                'short_name' => 'Tecnología',
                'slug' => 'tecnologia',
                'active' => 1,
            ],
            [
                'group' => 'post',
                'type' => 'categories',
                'position' => 2,
                'code' => 'salud',
                'name' => 'Salud',
                'short_name' => 'Salud',
                'slug' => 'salud',
                'active' => 1,
            ],
            [
                'group' => 'post',
                'type' => 'categories',
                'position' => 3,
                'code' => 'Finanzas',
                'name' => 'Finanzas',
                'short_name' => 'Finanzas',
                'slug' => 'Finanzas',
                'active' => 1,
            ],
            [
                'group' => 'post',
                'type' => 'categories',
                'position' => 4,
                'code' => 'programacion',
                'name' => 'Programacion',
                'short_name' => 'Programacion',
                'slug' => 'programacion',
                'active' => 1,
            ],
        ];
        DB::table('taxonomies')->insert($system);
    }
}
