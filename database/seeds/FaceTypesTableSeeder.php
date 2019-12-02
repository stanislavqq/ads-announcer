<?php

use Illuminate\Database\Seeder;

class FaceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('face_types')->delete();
        DB::table('face_types')->insert([
            ['id' => 1, 'slug_type' => 'individual', 'name' => 'Физическое лицо'],
            ['id' => 2, 'slug_type' => 'legal', 'name' => 'Юридическое лицо']
        ]);
    }
}
