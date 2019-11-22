<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckpointsTableVer2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('checkpoints', function (Blueprint $table) {
	      $table->increments('id');
        $table->integer('studentsParticipating')->nullable();
        $table->integer('gamesPerStudent')->nullable();
        $table->integer('curriculumPerStudent')->nullable();
        $table->integer('sportsmanshipPointsPerStudent')->nullable();
        $table->integer('gamesPlayed')->nullable();
        $table->integer('curriculumCompleted')->nullable();
        $table->integer('sportsmanshipPoints')->nullable();
        $table->integer('studentsEligible')->nullable();
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
        Schema::dropIfExists('checkpoints');
    }
}
