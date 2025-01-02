<?php

namespace Database\Seeders;

use App\Models\Role;
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
        // $user = User::factory(3)->create();
        // Role::factory(2)->create()->hasAttached($user);

        $this->call(PositionSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionPositionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JobSeeder::class);
    }
}
