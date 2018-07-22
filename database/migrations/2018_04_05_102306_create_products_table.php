<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price');
            $table->integer('quantity');
            $table->integer('product_category_id')->unsigned()->nullable();
            $table->integer('product_subcategory_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_category_id')
                ->references('id')
                ->on('product_categories');

            $table->foreign('product_subcategory_id')
                ->references('id')
                ->on('product_subcategories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
