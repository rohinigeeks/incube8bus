<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBBusRouteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dbbusroutes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('busRouteName','100');
			$table->integer('dbbusstop_id')->unsigned();
			$table->integer('order');
			$table->string('road','40');
			$table->decimal('kmDistance');
			$table->foreign('dbbusstop_id')->references('id')->on('dbbusstops');
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
		Schema::table('dbbusroutes', function(Blueprint $table)
		{
			Schema::drop('dbbusroutes');
		});
	}

}
