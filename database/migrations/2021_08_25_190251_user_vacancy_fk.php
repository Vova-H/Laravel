<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserVacancyFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_vacancies', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('vacancy_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('vacancy_id')->references('id')->on('vacancies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_vacancies', function (Blueprint $table) {
            $table->dropForeign(['vacancy_id','user_id']);
            $table->dropColumn('user_id','vacancy_id');
        });
    }
}
