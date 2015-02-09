<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBBusStopTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dbbusstops', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('address', '100');
			$table->double('latitude');
			$table->double('longitude');
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
		Schema::table('dbbusstops', function(Blueprint $table)
		{
			Schema::drop('dbbusstops');
		});
	}

}
