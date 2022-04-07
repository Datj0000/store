<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->create(
            [
                'category_name' => 'CPU',
            ],
            [
                'category_name' => 'Ram',
            ],
            [
                'category_name' => 'Tản nhiệt',
            ],
            [
                'category_name' => 'Main',
            ],
            [
                'category_name' => 'Card',
            ],
            [
                'category_name' => 'Chuột',
            ],
            [
                'category_name' => 'USB',
            ],
            [
                'category_name' => 'Ổ cứng',
            ],
            [
                'category_name' => 'Dây cáp',
            ],
            [
                'category_name' => 'Webcam',
            ],
            [
                'category_name' => 'Nguồn máy tính',
            ],
            [
                'category_name' => 'Case',
            ],
            [
                'category_name' => 'Loa',
            ],
            [
                'category_name' => 'Lót chuột',
            ],
        );
    }
}
