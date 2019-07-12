<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->nullable();
            $table->string('title');
            $table->string('original_title')->nullable();
            $table->string('other_title')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('description_short')->nullable();
            $table->integer('kp_raiting')->nullable();
            $table->integer('imdb_raiting')->nullable();
            $table->string('image')->nullable();
            $table->boolean('image_show')->nullable();
            $table->string('hdgo_link')->nullable();
            $table->string('kodik_link')->nullable();
            $table->string('moonwalk_link')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('published')->nullable();
            $table->integer('views')->nullable();
            $table->date('premiere')->nullable();
            $table->string('quality')->nullable();
            $table->string('translation')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('kp_id')->unique()->nullable();
            $table->string('imdb_id')->unique()->nullable();
            $table->string('hdgo_id')->unique()->nullable();
            $table->string('kodik_id')->unique()->nullable();
            $table->string('moonwalk_id')->unique()->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
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
        Schema::dropIfExists('movies');
    }

}
