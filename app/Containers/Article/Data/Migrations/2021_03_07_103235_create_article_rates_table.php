<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleRatesTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('article_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->integer('rating')->unsigned();
            $table->string('ip_address', 45);
            $table->timestamps();
            //$table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('article_ratings');
    }
}
