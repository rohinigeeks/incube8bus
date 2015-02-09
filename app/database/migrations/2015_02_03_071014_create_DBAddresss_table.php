<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBAddresssTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dbaddresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('addressLine1','40');
			$table->string('addressLine2','40');
			$table->string('city','40');
			$table->string('zipCode','10');
			$table->string('country','20');
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
		Schema::table('dbaddresses', function(Blueprint $table)
		{
			Schema::drop('dbaddresses');
			
		});
	}

}
