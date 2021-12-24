<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert(
            [
                        [
                        'id' => 1, 
                        'parent_id' => 0,
                        'section_id' => 1,
                        'category_name' => 'T-Shirt', 
                        'category_image' => "",
                        'category_discount' => 0.0,
                        'description' => "",
                        'url' => "",
                        'meta_title' => "",
                        'meta_description' => "",
                        'meta_keywords' => "",
                        'status' => 1,
                        'created_at' => Now(),
                        'updated_at' => Now()
                        ],
                    
                        [
                            'id' => 2, 
                            'parent_id' => 0,
                            'section_id' => 1,
                            'category_name' => 'Casual Shirt', 
                            'category_image' => "",
                            'category_discount' => 0.0,
                            'description' => "",
                            'url' => "",
                            'meta_title' => "",
                            'meta_description' => "",
                            'meta_keywords' => "",
                            'status' => 1,
                            'created_at' => Now(),
                            'updated_at' => Now()
                            ],
                            [
                                'id' => 3, 
                                'parent_id' => 0,
                                'section_id' => 1,
                                'category_name' => 'Office Shirt', 
                                'category_image' => "",
                                'category_discount' => 0.0,
                                'description' => "",
                                'url' => "",
                                'meta_title' => "",
                                'meta_description' => "",
                                'meta_keywords' => "",
                                'status' => 1,
                                'created_at' => Now(),
                                'updated_at' => Now()
                                ],
                         ]
        );
    }
}
