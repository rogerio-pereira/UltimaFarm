<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInvoicesTable.
 */
class CreateInvoicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->double('value');
            $table->decimal('profitability');
            $table->datetime('deadline');
            $table->double('refundValue');
            $table->string('token')->nullable();
            $table->string('payerID')->nullable();
            $table->string('status')->nullable();
            $table->boolean('processed')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients');

            $table->foreign('product_id')
                    ->references('id')
                    ->on('products');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('invoices');
	}
}
