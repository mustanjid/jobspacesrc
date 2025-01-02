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

class PermissionPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::get();
        foreach ($permissions as $permission) {
            DB::table('permission_position')->insert(
                [
                    'position_id' => Position::select('id')->first()->id,
                    'permission_id' => $permission->id,
                ]
            );
        }
    }
}
