<?php

use Illuminate\Database\Seeder;

class CaratteristicheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //DB::table('tblCaratteristiche')->truncate();

      DB::table('tblCaratteristiche')->insert([
      		['nome' => 'Senza Lievito'], 
      		['nome' => 'Senza Uova'],
      		['nome' => 'Senza Sale'] ,
      		['nome' => 'Senza Lattosio'], 
      		['nome' => 'Senza Zucchero'],
      		['nome' => 'Senza Soia'],
      		['nome' => 'Biologico'],
      		['nome' => 'Spiga Sbarrata'], 
      	]);
    }
}
