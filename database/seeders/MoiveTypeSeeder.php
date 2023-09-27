<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoiveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movieTypes = [
            'Phim lẻ',
            'Phim bộ',
            'Phim chiếu rạp'
        ];

        foreach ($movieTypes as $movieType) {
            DB::table('movie_types')->insert([
                'name' => $movieType
            ]);
        }
    }
}
