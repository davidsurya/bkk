<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnConfirmTableApplicant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicant_user', function (Blueprint $table) {
            $table->smallInteger('confirm')->after('status')->default(0)->unsigned();
            $table->smallInteger('read')->after('confirm')->default(0)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicant_user', function (Blueprint $table) {
            $table->dropColumn('confirm');
            $table->dropColumn('read');
        });
    }
}
