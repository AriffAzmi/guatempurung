<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('package_type');
            $table->dateTime('goingdate');
            $table->integer('senior_citizen')->nullable();
            $table->integer('adults')->nullable();
            $table->integer('childs')->nullable();
            $table->string('transaction_id')->nullable();
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
        Schema::drop('booking');
    }
}
