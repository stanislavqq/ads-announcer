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
        $this->call(CategoryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(FaceTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AdsTableSeeder::class);
    }
}