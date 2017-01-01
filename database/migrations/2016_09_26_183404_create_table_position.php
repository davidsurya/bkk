<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('information_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('name');
            $table->text('definition');
            $table->text('skill');
            $table->integer('height')->unsigned();
            $table->integer('weight')->unsigned();
            $table->double('score');
            $table->integer('total');
            $table->integer('min_age');
            $table->integer('max_age');
            $table->string('sex', 3);
            $table->text('requirement');
            $table->string('location');
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
        Schema::drop('position');
    }
}
