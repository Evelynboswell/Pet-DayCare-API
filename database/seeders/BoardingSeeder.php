<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Boarding;

class BoardingSeeder extends Seeder
{
    public function run()
    {
        Boarding::insert([
            [
                'boarding_name' => 'Standard Daycare',
                'boarding_type' => 'Standard',
                'boarding_description' => 'A comfortable stay with basic amenities.',
                'price' => 50000,
                'current_stock' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'boarding_name' => 'Luxury Daycare',
                'boarding_type' => 'Luxury',
                'boarding_description' => 'Luxurious accommodations with additional amenities.',
                'price' => 150000,
                'current_stock' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
