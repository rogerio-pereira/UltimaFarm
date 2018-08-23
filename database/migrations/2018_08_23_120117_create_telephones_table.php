<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTelephonesTable.
 */
class CreateTelephonesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telephones', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('address_category_id')->unsigned();
            $table->string('description')->nullable();
            $table->string('telephone');
            $table->boolean('whatsapp')->default('0');
            $table->boolean('active')->default('1');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('address_category_id')
                ->references('id')
                ->on('address_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('telephones');
	}
}
