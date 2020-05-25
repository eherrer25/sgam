<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersResidentsNursingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_residents_nursings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('resident_id')->unsigned();
            $table->foreign('resident_id')->references('id')->on('residents');

            $table->bigInteger('nursing_id')->unsigned();
            $table->foreign('nursing_id')->references('id')->on('nursings');

            $table->string('start_unreal')->nullable();
            $table->string('stop_unreal')->nullable();
            $table->string('start');
            $table->string('stop');
            $table->string('status');

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
        Schema::dropIfExists('users_residents_nursings');
    }
}
