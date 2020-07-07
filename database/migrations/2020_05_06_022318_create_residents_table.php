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
            $table->string('studies')->nullable();
            $table->string('profession')->nullable();

            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->bigInteger('civil_id')->unsigned();
            $table->foreign('civil_id')->references('id')->on('civil_statuses');
            $table->bigInteger('bed_id')->unsigned();
            $table->foreign('bed_id')->references('id')->on('beds');

            $table->timestamps();

            $table->softDeletes();
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
