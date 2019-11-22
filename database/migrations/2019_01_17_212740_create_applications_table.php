<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_name')->nullable();
            $table->string('student_grade_level')->nullable();
            $table->string('school_program_name')->nullable();
            $table->string('favorite_team')->nullable();
            $table->string('educator_name')->nullable();
            $table->string('team_region')->nullable();
            $table->string('games_played')->nullable();
            $table->string('curriculum_pieces_completed')->nullable();
            $table->string('sportsmanship_points_earned')->nullable();
            $table->longText('letter_of_recommendation')->nullable();
            $table->string('applicant_video')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
