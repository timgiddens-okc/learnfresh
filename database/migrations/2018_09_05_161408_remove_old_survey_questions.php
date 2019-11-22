<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveOldSurveyQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preassessments', function (Blueprint $table) {
            $table->dropColumn('try_hard');
            $table->dropColumn('complete_assignments');
            $table->dropColumn('scare');
            $table->dropColumn('rarely_use');
            $table->dropColumn('give_up');
            $table->dropColumn('future_work');
            $table->dropColumn('math_related_activities');
            $table->dropColumn('competitive');
            $table->dropColumn('respectful');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preassessments', function (Blueprint $table) {
            //
        });
    }
}
