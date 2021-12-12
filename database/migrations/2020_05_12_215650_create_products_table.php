<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users');
			$table->string('name');
			$table->string('price');
			$table->string('image');
		});
	}

	public function down()
	{
        Schema::dropIfExists('products');
	}
}