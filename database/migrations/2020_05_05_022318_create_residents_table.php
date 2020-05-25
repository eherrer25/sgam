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
