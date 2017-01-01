<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('raport', 4);
            $table->string('un', 4);
            $table->string('un_mtk', 4);
            $table->string('kejuruan', 4);
            $table->string('sem1', 4);
            $table->string('sem2', 4);
            $table->string('sem3', 4);
            $table->string('sem4', 4);
            $table->string('sem5', 4);
            $table->string('sem6', 4);
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
        Schema::drop('score');
    }
}
