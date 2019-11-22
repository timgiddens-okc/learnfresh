<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinalQuestionsToPostTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postassessments', function (Blueprint $table) {
            $table->integer('games_completed')->unsigned()->nullable();
            $table->integer('skills_pieces')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postassessments', function (Blueprint $table) {
            $table->dropColumn('games_completed');
            $table->dropColumn('skills_pieces');
        });
    }
}
