<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('middlename_second')->nullable();
            $table->string('middlename_third')->nullable();
            $table->string('middlename_fourth')->nullable();
            $table->string('lastname')->nullable();
            $table->string('lastneme_prefix')->nullable();
            $table->string('name_en')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('description_short')->nullable();
            $table->integer('sex')->nullable();
            $table->integer('height')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('death_date')->nullable();
            $table->string('country_birth_id')->nullable();
            $table->string('city_birth_id')->nullable();
            $table->string('country_death_id')->nullable();
            $table->string('city_death_id')->nullable();
            $table->string('image')->nullable();
            $table->boolean('image_show')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('published')->nullable();
            $table->integer('views')->nullable();
            $table->integer('kp_id')->unique();
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
        Schema::dropIfExists('persons');
    }

}
