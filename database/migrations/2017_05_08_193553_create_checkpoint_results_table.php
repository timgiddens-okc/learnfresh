<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckpointResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkpoint_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('games')->unsigned();
            $table->integer('curriculum')->unsigned();
            $table->integer('sportsmanship')->unsigned();
            $table->string('student-1-name');
            $table->integer('student-1-games')->unsigned();
            $table->integer('student-1-skills')->unsigned();
            $table->integer('student-1-bonus')->unsigned();
            $table->string('student-2-name');
            $table->integer('student-2-games')->unsigned();
            $table->integer('student-2-skills')->unsigned();
            $table->integer('student-2-bonus')->unsigned();
            $table->string('student-3-name');
            $table->integer('student-3-games')->unsigned();
            $table->integer('student-3-skills')->unsigned();
            $table->integer('student-3-bonus')->unsigned();
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('checkpoint_results');
    }
}
