<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDBBusServiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dbbusservices', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('serviceName','10');
                        $table->enum('serviceType',array(0, 1, 2, 3));
			$table->string('start','60');
                        $table->string('end','60');
                        $table->string('busRouteName','60');
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
		Schema::table('dbbusservices', function(Blueprint $table)
		{
			Schema::drop('dbbusservices');
		});
	}

}
