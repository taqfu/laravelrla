<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectiveAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospective_achievements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('election_id')->unsigned();
            $table->char('name', 255);
            $table->integer('user_id')->unsigned();
            $table->dateTime('completed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prospective_achievements');
    }
}
