<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupConnectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_connects', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->references('id')->on('users');
			$table->integer('group_id')->references('id')->on('groups');
			$table->integer('group_connection');
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
        Schema::dropIfExists('group_connects');
    }
}
