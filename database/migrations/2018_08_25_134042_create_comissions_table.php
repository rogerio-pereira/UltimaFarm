<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateComissionsTable.
 */
class CreateComissionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comissions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('sale_id')->unsigned();
            $table->double('value');
            $table->datetime('deadline');
            $table->boolean('refunded')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');

            $table->foreign('sale_id')
                    ->references('id')
                    ->on('sales');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comissions');
	}
}
