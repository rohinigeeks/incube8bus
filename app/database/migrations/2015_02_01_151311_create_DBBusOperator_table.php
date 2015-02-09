<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBBusOperatorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dbbusoperators', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('companyName','40');
                        $table->integer('address_id')->unsigned();
                        $table->string('contactEnquiry','10');
                        $table->string('contactHotline','10');
                        $table->string('contactEmail','40');
                        $table->foreign('address_id')->references('id')->on('dbaddresses');
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
		Schema::table('dbbusoperators', function(Blueprint $table)
		{
			Schema::drop('dbbusoperators');
		});
	}

}
