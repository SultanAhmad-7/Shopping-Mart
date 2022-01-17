<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->delete();
        DB::table('banners')->insert(
            [
                ['id' => 1, 'image' => '1.png', 'link' => '','title' => 'Black Jacket', 'alt' => 'Black Jacket','status' =>1, 'created_at' => Now(), 'updated_at' => Now()],
                ['id' => 2, 'image' => '2.png', 'link' => '','title' => 'Blue T-Shirt', 'alt' => 'Blue T-Shirt','status' =>1, 'created_at' => Now(), 'updated_at' => Now()],
                ['id' => 3, 'image' => '3.png', 'link' => '','title' => 'Dark Blue T-Shirt', 'alt' => 'Dark Blue T-Shirt','status' =>1, 'created_at' => Now(), 'updated_at' => Now()]
            ]
        );
    }
}
