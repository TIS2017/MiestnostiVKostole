<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('date_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->foreign('date_id')->references('id')->on('dates')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->integer('repeat');
            $table->boolean('blacklisted');
            $table->boolean('is_approved');
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
        Schema::dropIfExists('meetings');
    }
}
