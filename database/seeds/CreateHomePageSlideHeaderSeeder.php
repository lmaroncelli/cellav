<?php

use Illuminate\Database\Seeder;

class CreateHomePageSlideHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('tblSlide')->insert(
           [
           'titolo' => 'hp_slide_header'
           ]
       );
    }
}
