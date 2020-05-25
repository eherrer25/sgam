<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->bigIncrements('id');
<<<<<<< HEAD
            $table->string('run');
            $table->string('name');
            $table->string('last_name');
            $table->string('email');
            $table->string('gender');
            $table->date('birth_of_date');
            $table->date('date_fun');
            $table->string('room');
            $table->string('studies');
            $table->string('profession');
            $table->string('civil_status');
            $table->date('date_in');
            $table->date('date_out');
=======

            $table->string('run');
            $table->string('name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('birth_of_date');
            $table->string('room');
            $table->string('studies');
            $table->string('profession');

            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->bigInteger('office_id')->unsigned();
            $table->foreign('office_id')->references('id')->on('offices');
            $table->bigInteger('civil_id')->unsigned();
            $table->foreign('civil_id')->references('id')->on('civil_statuses');
            $table->bigInteger('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms');

>>>>>>> 4444ceacfcfa8f524aaffb6dc9f6750946acd692
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
        Schema::dropIfExists('residents');
    }
}
