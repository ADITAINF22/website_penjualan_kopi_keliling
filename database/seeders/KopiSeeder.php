<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\RouteStop;

class KopiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            ['name' => 'Kopi Susu Gula Aren', 'description' => 'Espresso, susu segar, gula aren', 'price' => 15000, 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Americano',           'description' => 'Espresso + air, segar dan ringan', 'price' => 12000, 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Latte',               'description' => 'Espresso dengan susu lembut',      'price' => 17000, 'is_available' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        RouteStop::insert([
            ['place_name' => 'Taman Kota',   'address' => 'Jl. Contoh No. 1', 'day' => 1, 'start_time' => '07:00', 'end_time' => '10:00', 'created_at' => now(), 'updated_at' => now()],
            ['place_name' => 'Area Kampus',  'address' => 'Jl. Contoh No. 2', 'day' => 2, 'start_time' => '08:00', 'end_time' => '12:00', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
