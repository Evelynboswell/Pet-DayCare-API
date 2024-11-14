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
                'boarding_name' => 'Basic Boarding',
                'boarding_type' => 'Standard',
                'boarding_description' => 'A comfortable stay with basic amenities.',
                'price' => 50000,
                'current_stock' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'boarding_name' => 'Luxury Boarding',
                'boarding_type' => 'Premium',
                'boarding_description' => 'Luxurious accommodations with additional amenities.',
                'price' => 150000,
                'current_stock' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
