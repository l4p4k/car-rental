<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarRentalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental', function (Blueprint $table) {
            $table->increments('rental_id')->unique();
            $table->integer('user_id');
            $table->string('title', 50);
            $table->string('description', 255);
            $table->string('make', 20);
            $table->string('model', 30);
            $table->string('colour', 20);
            $table->string('type', 20);
            $table->string('fuel', 10);
            $table->string('transmission', 1);
            $table->string('doors', 2);
            $table->double('engine_cc', 3, 2);
            $table->string('mpg', 3);
            $table->string('contract_length', 50);
            $table->string('avail', 1);
            $table->string('img', 1);
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
        Schema::drop('rental');
    }
}
