<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('description');
            $table->text('text');
            $table->integer('page_category_id')->unsigned();
            $table->boolean('show_title')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('page_category_id')
                ->references('id')
                ->on('page_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}

}
