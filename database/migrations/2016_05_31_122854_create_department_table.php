<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('name');            
            $table->timestamps();
        });

        DB::table('department')->insert([
            'name' => 'Teknik Komputer Jaringan'
            ],[
            'name' => 'Multimedia'
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('department');
    }
}
