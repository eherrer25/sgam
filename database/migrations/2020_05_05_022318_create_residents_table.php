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
