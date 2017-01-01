<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();            
            $table->integer('industry_id');
            $table->string('title');
            $table->text('definition');
            $table->date('deadline');
            $table->text('requirement');
            $table->text('other');
            $table->string('img');
            $table->boolean('hidden');
            $table->integer('read')->unsigned();
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
        Schema::drop('information');
    }
}
