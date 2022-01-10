<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_images')->delete();
        DB::table('product_images')->insert(
            [
                    'id' => 1,
                    'product_id' => 1, 
                    'image' => 'person_2.jpg-4125.jpg', 
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now()]
        );
    }
}
