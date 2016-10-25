<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CaratteristicheSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(ProduttoriSeeder::class);
    }
}
