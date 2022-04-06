<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::query()->create(
            [
                'supplier_name' => 'Cái',
                'supplier_phone' => 'Bộ',
                'supplier_email' => 'Mét',
                'supplier_mst' => '5700133674',
                'supplier_address' => 'Hạ Long',
                'supplier_information' => 'MB bank 999999993599',
            ],
        );
    }
}
