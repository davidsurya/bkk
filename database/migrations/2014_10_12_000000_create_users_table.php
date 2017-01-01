<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->unsigned();            
            $table->integer('role_id')->unsigned();
            $table->string('username');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 12)->unique();
            $table->string('password');
            $table->date('birthday');
            $table->string('sex', 1);
            $table->string('graduation', 4);
            $table->text('address');
            $table->string('img')->default('/image/default.png');
            $table->text('skill');
            $table->integer('height')->unsigned();
            $table->integer('weight')->unsigned();            
            $table->text('location');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'role_id' => 1,
            'username' => 'dapid',
            'name' => 'David Surya Aji S',
            'email' => 'adminbkk@smk2wonosari.xyz',
            'phone' => '085743144965',
            'password' => bcrypt('dapid'),
            'birthday' => 1994-06-17,
            'sex' => 'L'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
