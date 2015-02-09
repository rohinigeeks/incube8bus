<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBBusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dbbus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('registration','40');
			$table->integer('dbbusmodel_id')->unsigned();
			$table->integer('dbbusoperator_id')->unsigned();
			$table->integer('dbbusservice_id')->unsigned();
			$table->foreign('dbbusmodel_id')->references('id')->on('dbbusmodels');
			$table->foreign('dbbusoperator_id')->references('id')->on('dbbusoperators');
			$table->foreign('dbbusservice_id')->references('id')->on('dbbusservices');
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
		Schema::table('dbbus', function(Blueprint $table)
		{
			Schema::drop('dbbus');
		});
	}

}
