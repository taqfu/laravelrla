<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnerIdToCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('criteria', function (Blueprint $table) {
            $table->integer('owner_id')->unsigned();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('criteria', function (Blueprint $table) {
            //
        });
    }
}
