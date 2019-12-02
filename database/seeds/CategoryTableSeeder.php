<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'авто'],
            ['id' => 2, 'name' => 'недвижимость'],
            ['id' => 3, 'name' => 'другое'],
        ]);

    }
}
