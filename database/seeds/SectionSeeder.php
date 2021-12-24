<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();
        DB::table('sections')->insert([
            ['id' => 1, 'name' => 'Men', 'status' => 1, 'created_at' => Now(), 'updated_at' => Now()],
            ['id' => 2, 'name' => 'Women', 'status' => 1, 'created_at' => Now(), 'updated_at' => Now()],
            ['id' => 3, 'name' => 'Kids', 'status' => 1, 'created_at' => Now(), 'updated_at' => Now()]
        ]);
    }
}
