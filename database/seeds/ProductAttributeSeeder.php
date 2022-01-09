<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_attributes')->delete();
        DB::table('product_attributes')->insert([
            ['id' => 1, 'product_id' => 1, 'size' => 'S', 'price' => 1200, 'stock' => 20, 'sku' => 'BG001-S', 'status' => 1,'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'product_id' => 1, 'size' => 'M', 'price' => 1500, 'stock' => 20, 'sku' => 'BG001-M', 'status' => 1,'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'product_id' => 1, 'size' => 'L', 'price' => 1800, 'stock' => 20, 'sku' => 'BG001-L', 'status' => 1,'created_at' => now(), 'updated_at' => now()],
        ]);
        
    }
}
