<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Roles extends Migration
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
        $table->string('name');
    });
	
		Schema::create('user_role', function (Blueprint $table) {
			$table->bigInteger('user_id')->unsigned();
			$table->integer('role_id')->unsigned();
			$table->foreign('user_id')
				->references('id')->on('user');
			$table->foreign('role_id')
				->references('id')->on('role');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
