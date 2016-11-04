<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblRuoli', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
           $table->integer('ruolo_id')->unsigned()->after('id');
           
           $table->foreign('ruolo_id')->references('id')->on('tblRuoli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblRuoli');

        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn('ruolo_id');
        });
    }
}
