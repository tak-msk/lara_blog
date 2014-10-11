<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// user table
		if(!Schema::hasTable('users')) {
			Schema::create('users', function($table) {
				$table->increments('id');
				$table->string('username')->unique();
				$table->string('password');
				$table->string('email');
				$table->timestamps();
			});
		}
		DB::table('users')->insert(array(
			'username' => 'admin',
			'password' => Hash::make('m119masaki'),
			'email' => 'tak.msk2580@gmail.com'
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::dropIfExists('users');
	}

}
