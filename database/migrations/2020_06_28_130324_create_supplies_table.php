<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSuppliesTable.
 */
class CreateSuppliesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supplies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('gas_station');
            $table->float('price', 5, 2);
            $table->float('price_liter', 5, 2);
            $table->string('date');
            $table->unsignedBigInteger('user_id')->nullable();
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
		Schema::drop('supplies');
	}
}
