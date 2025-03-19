<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'recovo',
            'email' => 'user@recovo.com',
            'password' => Hash::make('recovo123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
