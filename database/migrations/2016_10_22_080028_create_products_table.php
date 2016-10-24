<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblProdotti', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('codice');
            $table->string('peso');
            $table->text('descrizione');            
            $table->text('scheda');            
            $table->text('ingredienti');            
            $table->integer('disponibile');
            $table->date('scadenza');
            $table->decimal('prezzo', 10, 2);
            $table->decimal('prezzo_offerta', 10, 2);
            $table->boolean('novita')->default(false);
            $table->boolean('offerta')->default(false);
            $table->boolean('visibile')->default(false);
            $table->string('uri')->unique();
            $table->string('title');
            $table->string('keywords');            
            $table->text('description');            
            $table->integer('produttore_id')->unsigned();
            // se cancello un produttore voglio cancellare a cascata anche tutti i prodotti di quel produttore
            $table->foreign('produttore_id')->references('id')->on('tblProduttori')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblProdotti');
    }
}
