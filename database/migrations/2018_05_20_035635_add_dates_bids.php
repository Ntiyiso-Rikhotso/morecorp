<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesBids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('bid', function (Blueprint $table) {
			$table->string('updated_at');
			$table->string('created_at');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('bid', function (Blueprint $table) {
			$table->dropColumn('updated_at');
			$table->dropColumn('created_at');
		});
    }
}
