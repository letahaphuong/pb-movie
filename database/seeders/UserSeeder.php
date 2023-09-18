<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_name' => 'admin@gmail.com',
            'email' => 'admin@gmail.com',
            'password' => '$2a$10$/AzqmtFCX7b8RSQJZ7tdiOF2K1s64wvRSpSenyd4YqjYA9j0J9xgS',
            'full_name' => 'Admin',
            'date_of_birth' => '1995-09-13 14:30:00'
        ]);

        DB::table('users')->insert([
            'user_name' => 'user@gmail.com',
            'email' => 'user@gmail.com',
            'password' => '$2a$10$/AzqmtFCX7b8RSQJZ7tdiOF2K1s64wvRSpSenyd4YqjYA9j0J9xgS',
            'full_name' => 'USER',
            'date_of_birth' => '1995-09-13 14:30:00'
        ]);
    }
}
