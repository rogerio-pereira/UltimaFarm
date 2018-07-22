<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class)->create([
            'name' => 'Plano 1',
            'price' => 500,
            'deadline' => 6,
            'profitability' => 5,
            'active' => 1
        ]);
        
        factory(Product::class)->create([
            'name' => 'Plano 2',
            'price' => 1000,
            'deadline' => 6,
            'profitability' => 10,
            'active' => 1
        ]);
        
        factory(Product::class)->create([
            'name' => 'Plano 3',
            'price' => 5000,
            'deadline' => 6,
            'profitability' => 15,
            'active' => 1
        ]);
        
        factory(Product::class)->create([
            'name' => 'Plano 4',
            'price' => 10000,
            'deadline' => 6,
            'profitability' => 20,
            'active' => 1
        ]);
        
        factory(Product::class)->create([
            'name' => 'Plano 5',
            'price' => 50000,
            'deadline' => 6,
            'profitability' => 25,
            'active' => 1
        ]);
        
        factory(Product::class)->create([
            'name' => 'Plano 6',
            'price' => 100000,
            'deadline' => 6,
            'profitability' => 30,
            'active' => 1
        ]);
        
        factory(Product::class)->create([
            'name' => 'Plano 7',
            'price' => 500000,
            'deadline' => 6,
            'profitability' => 35,
            'active' => 1
        ]);
        
        factory(Product::class)->create([
            'name' => 'Plano 8',
            'price' => 1000000,
            'deadline' => 6,
            'profitability' => 40,
            'active' => 1
        ]);
    }
}
