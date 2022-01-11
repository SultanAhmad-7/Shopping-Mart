<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->delete();
        DB::table('brands')->insert([
                                    ['id' => 1, 'name' => 'Calvin Klein', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
                                    ['id' => 2, 'name' => 'Champion' , 'status' => 1, 'create_at' => now(), 'updated_at' => now()],
                                    ['id' => 3, 'name' => 'Disney' , 'status' => 1, 'create_at' => now(), 'updated_at' => now()]
        ]);
    }
}
