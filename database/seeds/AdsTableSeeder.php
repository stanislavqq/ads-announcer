<?php

use Illuminate\Database\Seeder;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ads')->delete();
        $ads = factory(\App\Models\Ad::class, 50)->create();
        $ads->each(function($ad) {
            $ad->country_id = $ad->city->country->id;
            $ad->save();
        });
    }
}
