<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalMsgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('message', function (Blueprint $table) {
            $table->increments('message_id')->unique();
            $table->integer('rental_msg_id');
            $table->integer('rental_id');
            $table->integer('user_id');
            $table->string('message_txt', 255);
            $table->string('message_img', 1);
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
        Schema::drop('message');
    }
}
