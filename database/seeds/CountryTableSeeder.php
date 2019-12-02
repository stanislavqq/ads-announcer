<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        DB::table('countries')->insert([
            ['slug_country' => 'russia', 'id' => 1, 'country' => 'Россия'],
            ['slug_country' => 'usa', 'id' => 2, 'country' => 'США'],
            ['slug_country' => 'german', 'id' => 3, 'country' => 'Германия'],
        ]);
    }
}
