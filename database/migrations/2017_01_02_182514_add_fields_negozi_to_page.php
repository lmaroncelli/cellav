<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsNegoziToPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblPages', function (Blueprint $table) {
            $table->string('seo_title');
            $table->text('seo_description');
            $table->integer('header_slide_id')->unsigned()->nullable()->default(null);
            $table->foreign('header_slide_id')->references('id')->on('tblSlide')->onDelete('cascade');
            $table->integer('prodotti_freschi_slide_id')->unsigned()->nullable()->default(null)->after('header_slide_id');
            $table->integer('prodotti_confezionati_slide_id')->unsigned()->nullable()->default(null)->after('prodotti_freschi_slide_id');
            $table->string('gm_nome')->default('')->after('desc_tiburtina');
            $table->string('gm_indirizzo')->default('')->after('gm_nome');
            $table->string('gm_lat',10)->default('')->after('gm_indirizzo');
            $table->string('gm_long',10)->default('')->after('gm_lat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblPages', function (Blueprint $table) {
            //
        });
    }
}
