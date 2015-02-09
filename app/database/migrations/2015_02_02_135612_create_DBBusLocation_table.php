<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBBusLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dbbuslocations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bus_id')->unsigned();
			$table->string('registration',40);
			$table->double('latitude');
			$table->double('longitude');
			$table->foreign('bus_id')->references('id')->on('dbbus');
			$table->dateTime('timestamp');
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
		Schema::table('dbbuslocations', function(Blueprint $table)
		{
			Schema::drop('dbbuslocations');
		});
	}

}
