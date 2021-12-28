<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        $products = [
            [
            'id' => 1, 'category_id' => 1, 'section_id' => 1,
            'product_name' => 'Office Shirt For Men', 'product_code' => 'B001',
            'product_color' => 'Blue', 'product_price' => 1500, 'product_discount' => 0,
            'product_weight' => 20, 'product_video' => '', 'main_image' => '',
            'description' => 'Office Shirt For Men', 'wash_care' => 'carefully wash',
            'fabric' => 'pure cotton', 'pattern' => '', 'sleeve' => '',
            'fit' => '', 'occasion' => '', 'meta_title' => '', 'meta_description' => '',
            'meta_keywords' => '', 'is_featured' => 'No', 'status' => 1, 'created_at' => Now(), 'updated_at' => Now()
            ],
            [
                'id' => 2, 'category_id' => 1, 'section_id' => 1,
                'product_name' => 'Office Shirt For Men', 'product_code' => 'Bl001',
                'product_color' => 'Black', 'product_price' => 2000, 'product_discount' => 10,
                'product_weight' => 25, 'product_video' => '', 'main_image' => '',
                'description' => 'Office Shirt For Men', 'wash_care' => 'carefully wash',
                'fabric' => 'pure cotton', 'pattern' => '', 'sleeve' => '',
                'fit' => '', 'occasion' => '', 'meta_title' => '', 'meta_description' => '',
                'meta_keywords' => '', 'is_featured' => 'No', 'status' => 1, 'created_at' => Now(), 'updated_at' => Now()
                ],
        ];

        DB::table('products')->insert($products);
    }
}
