<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarategorieProdottiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCategorieProdotti', function (Blueprint $table) {
            $table->integer('prodotto_id')->unsigned()->index();
            $table->foreign('prodotto_id')->references('id')->on('tblProdotti')->onDelete('cascade');
            $table->integer('categoria_id')->unsigned()->index();
            $table->foreign('categoria_id')->references('id')->on('tblCategorie')->onDelete('cascade');
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
        Schema::dropIfExists('tblCategorieProdotti');
    }
}