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
                'unit_name' => 'Cái',
            ],
            [
                'unit_name' => 'Bộ',
            ],
            [
                'unit_name' => 'Mét',
            ],
        );
    }
}
