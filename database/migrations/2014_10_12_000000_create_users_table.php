<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('users', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('ci')->nullable();
				$table->string('nombre')->nullable();
				$table->string('apellido')->nullable();
				$table->date('fec_nac')->nullable();
				$table->integer('telefono')->nullable();
				$table->string('email')->unique();
				$table->string('password');
				$table->string('zona', 350)->nullable();
				$table->integer('distrito')->nullable();
				$table->rememberToken();
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
			Schema::dropIfExists('users');
		}
	}
