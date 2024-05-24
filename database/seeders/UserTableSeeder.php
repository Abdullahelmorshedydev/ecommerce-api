<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        User::factory(10)->create();
        User::create([
            'name' => 'Admin Morshedy',
            'email' => 'morshedy@admin.com',
            'password' => Hash::make('morshedy'),
            'role' => 2,
        ]);
        User::create([
            'name' => 'User Morshedy',
            'email' => 'morshedy@user.com',
            'password' => Hash::make('morshedy'),
            'role' => 1,
        ]);
    }
}
