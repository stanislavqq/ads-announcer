<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();
        DB::table('cities')->insert([
            ['slug_city' => 'moscow','city' => 'Москва', 'country_id' => 1],
            ['slug_city' => 'sanct-peterburg','city' => 'Санкт-Петербург', 'country_id' => 1],
            ['slug_city' => 'kaliningrad','city' => 'Калининград', 'country_id' => 1],
            ['slug_city' => 'chelyabinsk','city' => 'Челябинск', 'country_id' => 1],

            ['slug_city' => 'newyork','city' => 'Нью-Йорк', 'country_id' => 2],
            ['slug_city' => 'los-angeles','city' => 'Лос-Анджелес', 'country_id' => 2],
            ['slug_city' => 'chicago','city' => 'Чикаго', 'country_id' => 2],
            ['slug_city' => 'seattle','city' => 'Сиэтл', 'country_id' => 2],

            ['slug_city' => 'berlin','city' => 'Берлин', 'country_id' => 3],
            ['slug_city' => 'hamburg','city' => 'Гамбург', 'country_id' => 3],
            ['slug_city' => 'munhen','city' => 'Мюнхен', 'country_id' => 3],
            ['slug_city' => 'koln','city' => 'Кёльн', 'country_id' => 3],

        ]);
    }
}
