<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('role', 15);
            $table->string('description');
            $table->timestamps();
        });

        DB::table('role')->insert([[
                'role' => 'Admin',
                'description' => 'Administrator sistem yang memiliki hak akses penuh sistem.'                
            ],[
                'role' => 'Alumni',
                'description' => 'Pengguna yang memiliki hak akses ke sistem.'
            ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role');
    }
}
