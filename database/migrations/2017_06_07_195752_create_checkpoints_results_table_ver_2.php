<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckpointsResultsTableVer2 extends Migration
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
        $table->integer('studentsParticipating')->nullable();
        $table->integer('gamesPerStudent')->nullable();
        $table->integer('curriculumPerStudent')->nullable();
        $table->integer('sportsmanshipPointsPerStudent')->nullable();
        $table->integer('gamesPlayed')->nullable();
        $table->integer('curriculumCompleted')->nullable();
        $table->integer('sportsmanshipPoints')->nullable();
        $table->integer('studentsEligible')->nullable();
        $table->integer('user_id')->nullable();
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
