<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::query()->create(
            [
                'brand_name' => 'Lexar',
            ],
            [
                'brand_name' => 'Asus',
            ],
            [
                'brand_name' => 'Kingston',
            ],
            [
                'brand_name' => 'Corsair',
            ],
            [
                'brand_name' => 'Pisen',
            ],
            [
                'brand_name' => 'MSI',
            ],
            [
                'brand_name' => 'Xiaomi',
            ],
            [
                'brand_name' => 'HP',
            ],
            [
                'brand_name' => 'Tomato',
            ],
            [
                'brand_name' => 'Logitech',
            ],
            [
                'brand_name' => 'LG',
            ],
            [
                'brand_name' => 'BenQ',
            ],
            [
                'brand_name' => 'Lenovo',
            ],
            [
                'brand_name' => 'AKKO',
            ],
        );
    }
}
