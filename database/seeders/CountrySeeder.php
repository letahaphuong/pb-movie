<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            'Việt Nam',
            'Mỹ',
            'Trung Quốc',
            'Hàn Quốc',
            'Nhật Bản'
        ];

        foreach ($countries as $country) {
            DB::table('countries')->insert([
                'name' => $country
            ]);
        }
    }
}
