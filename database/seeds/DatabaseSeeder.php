<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      //  $this->call(UsersTableSeeder::class);
    //    $this->call(AdminSeederTable::class);
    //    $this->call(SectionSeeder::class);
    //   $this->call(CategorySeeder::class);
    //    $this->call(ProductSeeder::class);
    //  $this->call(ProductAttributeSeeder::class);
    //  $this->call(ProductImageSeeder::class);
    // $this->call(BrandSeeder::class);
      $this->call(BannerSeeder::class);
    }
}
