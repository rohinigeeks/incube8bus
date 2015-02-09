<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBBusModelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dbbusmodels', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('modelName','40');
			$table->string('manufacturer','40');
			//$table->enum('bodyType', array(BusModel::BODYTYPE_UNDEFINED, BusModel::BODYTYPE_SINGLEDECK,
			//			       BusModel::BODYTYPE_DOUBLEDECK, BusModel::BODYTYPE_RIGID,
			//			       BusModel::BODYTYPE_ARTICULATED));
			$table->enum('bodyType', array(0,1,2,3,4));
			$table->string('entry','10');
			$table->string('emissionStandard','10');
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
		Schema::table('dbbusmodels', function(Blueprint $table)
		{
			Schema::drop('dbbusmodels');
		});
	}

}
