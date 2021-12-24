<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            'id' => 1,
            'name' => 'Administrator',
            'type' => 'admin', 
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$lXQrIi2ulAReTK8eL0piteUcjDU37rEkguz68rjBiIn/f92OY.6A.',
            // password here is 1234
        ]);
        
    }
}
