<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Cổ trang',
            'Giả tưởng',
            'Hình sự',
            'Kiếm hiệp',
            'Phiêu lưu',
            'Tình cảm',
            'Trinh thám',
            'Chiến tranh',
            'Hài',
            'Hoạt hình',
            'Kinh dị',
            'Siêu anh hùng',
            'Thảm họa',
            'Võ thuật',
            'Chính trị',
            'Hành động',
            'Khoa học viễn tưởng',
            'Lịch sử',
            'Sử thi',
            'Thiếu nhi'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category
            ]);
        }
    }
}
