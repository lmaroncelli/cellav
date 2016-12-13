<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabellaHomepage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblHomePages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seo_title');
            $table->text('seo_description');
            $table->text('content');
            $table->boolean('listing')->default(false);
            $table->string('listingCategorie')->nullable()->default(null);
            $table->string('listingCaratteristiche')->nullable()->default(null);
            $table->integer('header_slide_id')->unsigned();
            $table->foreign('header_slide_id')->references('id')->on('tblSlide')->onDelete('cascade');
            $table->string('img_lab')->nullable()->default('');
            $table->text('desc_lab');
            $table->string('img_cipro')->nullable()->default('');
            $table->text('desc_cipro');
            $table->string('img_tiburtina')->nullable()->default('');
            $table->text('desc_tiburtina');
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
        Schema::dropIfExists('tblHomePages');
    }
}
