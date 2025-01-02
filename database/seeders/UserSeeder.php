<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => "Admin",
            'email' => 'admin@example.com',
            'position_id' => Position::select('id')->first()->id,
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'status' => 1,
            'remember_token' => 1234,
        ]);
    }
}
