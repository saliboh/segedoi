<?php

namespace Database\Seeders;

use App\Enums\UserRoleTypeEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => UserRoleTypeEnum::ADMIN->value,
        ]);

        User::create([
            'first_name' => 'Andrean',
            'last_name' => 'Erasmo',
            'email' => 'andrean@example.com',
            'password' => 'password',
            'role' => UserRoleTypeEnum::ADMIN->value,
        ]);
    }
}
