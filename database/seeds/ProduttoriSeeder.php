<?php

use Illuminate\Database\Seeder;

class ProduttoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //DB::table('tblProduttori')->truncate();

      DB::table('tblProduttori')->insert([
      		['nome' => 'Cose dell\'altro pane'], 
      		['nome' => 'Dr. Schaer'],
      		['nome' => 'Bi-Aglut'] ,
      		['nome' => 'Glutafin'], 
      		['nome' => 'Estrella Damm'],
      		['nome' => 'Alinor'],
      		['nome' => 'Cascina Belcreda'],
      		['nome' => 'Pandea'],
      		['nome' => 'Lima'],
      		['nome' => 'GolositÃ  dal 1885'],
      		['nome' => 'Farmo'],
      		['nome' => 'Colombo'],
      		['nome' => 'Primeal'],
      		['nome' => 'Pasta D\'Alessio'],
      		['nome' => 'Rapunzel'],
      		['nome' => 'Agluten'],
      		['nome' => 'Nutrifree'],
      		['nome' => 'Piaceri Mediterranei'],
      		['nome' => 'Probios'],
      		['nome' => 'Lo Conte'],
      		['nome' => 'Vital Nature'],
      		['nome' => 'Venchi'],
      		['nome' => 'Revolution'],
      		['nome' => 'La fabbrica del panforte'],
      		['nome' => 'Motta'],
      		['nome' => 'Bauli'],
      		['nome' => 'Celiachiamo LAB'],



      	]);
    }
}
