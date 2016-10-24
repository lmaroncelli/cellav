<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //DB::table('tblCategorie')->truncate();

      DB::table('tblCategorie')->insert([
      		['nome' => 'Pane pizza e...'], 
      		['nome' => 'Dolci e Biscotti'],
      		['nome' => 'Farine'] ,
      		['nome' => 'Pasta e Riso'], 
      		['nome' => 'Freschi e artigianali'],
      		['nome' => 'Area Bimbi'],
      		['nome' => 'Varie'],
      	]);
    }
}
