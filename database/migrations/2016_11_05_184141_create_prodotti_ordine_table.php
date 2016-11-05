<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdottiOrdineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblProdottiOrdine', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ordine_id')->unsigned();
            $table->integer('prodotto_id')->unsigned();
            $table->integer('numero')->default(1);
            $table->decimal('prezzo', 10, 2)->default(0.00);
            $table->foreign('ordine_id')->references('id')->on('tblOrdini')->onDelete('cascade');
            $table->foreign('prodotto_id')->references('id')->on('tblProdotti')->onDelete('cascade');
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
        Schema::dropIfExists('tblProdottiOrdine');
    }
}
