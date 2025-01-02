<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions =
            [
                [
                    'name' => "user",
                    'slug' => 'user',
                    'groupby' => 1,
                ],
                [
                    'name' => "add user",
                    'slug' => 'add user',
                    'groupby' => 1,

                ],
                [
                    'name' => "update user",
                    'slug' => 'update user',
                    'groupby' => 1,

                ],
                [
                    'name' => "delete user",
                    'slug' => 'delete user',
                    'groupby' => 1,

                ],
                [
                    'name' => "employer",
                    'slug' => 'employer',
                    'groupby' => 2,

                ],
                [
                    'name' => "add employer",
                    'slug' => 'add employer',
                    'groupby' => 2,

                ],
                [
                    'name' => "update employer",
                    'slug' => 'update employer',
                    'groupby' => 2,

                ],
                [
                    'name' => "delete employer",
                    'slug' => 'delete employer',
                    'groupby' => 2,

                ],
                [
                    'name' => "job",
                    'slug' => 'job',
                    'groupby' => 3,

                ],
                [
                    'name' => "add job",
                    'slug' => 'add job',
                    'groupby' => 3,
                ],
                [
                    'name' => "update job",
                    'slug' => 'update job',
                    'groupby' => 3,
                ],
                [
                    'name' => "delete job",
                    'slug' => 'delete job',
                    'groupby' => 3,
                ],
                [
                    'name' => "role",
                    'slug' => 'role',
                    'groupby' => 4,
                ],
                [
                    'name' => "add role",
                    'slug' => 'add role',
                    'groupby' => 4,
                ],
                [
                    'name' => "update role",
                    'slug' => 'update role',
                    'groupby' => 4,
                ],
                [
                    'name' => "delete role",
                    'slug' => 'delete role',
                    'groupby' => 4,
                ],
            ];

        collect($permissions)->each(function ($permission) {
            Permission::factory()->create($permission);
        });
    }
}
