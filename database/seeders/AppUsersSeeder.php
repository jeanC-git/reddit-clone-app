<?php

namespace Database\Seeders;

use App\Models\v1\AppUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AppUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client1 = AppUser::create([
            'name' => 'App User 1',
            'last_name' => 'Lastname',
            'email' => 'app_user1@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $client2 = AppUser::create([
            'name' => 'App User 2',
            'last_name' => 'Lastname',
            'email' => 'app_user2@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $client3 = AppUser::create([
            'name' => 'App User 3',
            'last_name' => 'Lastname',
            'email' => 'app_user3@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $client3 = AppUser::create([
            'name' => 'App User 4',
            'last_name' => 'Lastname',
            'email' => 'app_user4@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
