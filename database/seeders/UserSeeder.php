<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create(
            [
                'name' => 'Nguyễn Tiến Đạt',
                'email' => 'nguyentiendat@funnydev.vn',
                'phone' => '0398195552',
                'password' => '$2a$12$4fMH3njL41xmRf52qyRaXuAxMiABDbdUUd2YVlWr0RBP3KHSdweme',
                'role' => '0',
            ]
        );
    }
}
