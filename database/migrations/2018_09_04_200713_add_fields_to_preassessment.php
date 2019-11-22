<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToPreassessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preassessments', function (Blueprint $table) {
          $table->string('stay_calm')->nullable();
          $table->string('help_others')->nullable();
          $table->string('doing_things')->nullable();
          $table->string('solving_problems')->nullable();
          $table->string('do_not_give_up')->nullable();
          $table->string('give_compliments')->nullable();
          $table->string('do_the_right_thing')->nullable();
          $table->string('making_decisions')->nullable();
          $table->string('think_before_i_act')->nullable();
          $table->string('leader')->nullable();
          $table->string('respect')->nullable();
          $table->string('good_decisions')->nullable();
          $table->string('honest_person')->nullable();
          $table->string('importance_of_learning')->nullable();
          $table->string('think_about_problems')->nullable();
          $table->string('responsible_person')->nullable();
          $table->string('work_through_problems')->nullable();
          $table->string('set_goals')->nullable();
          $table->string('overcome_a_challenge')->nullable();
          $table->string('work_well_with_others')->nullable();
          $table->string('half_of_value')->nullable();
          $table->string('decimal_numbers_represent')->nullable();
          $table->string('nfl_kicker')->nullable();
          $table->string('free_throws')->nullable();
          $table->string('wnba_free_throws')->nullable();
          $table->string('same_shots')->nullable();
          $table->string('odds_of_three_point')->nullable();
          $table->string('shot_odds')->nullable();
          $table->dropColumn('lebron_james');
          $table->dropColumn('draft');
          $table->dropColumn('shooting_percentage');
          $table->dropColumn('missed_shot');
          $table->dropColumn('circle_graph');
          $table->dropColumn('steph_curry');
          $table->dropColumn('dwight_howard');
          $table->dropColumn('weight');
          $table->dropColumn('rookie');
          $table->dropColumn('grid');
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
	        $table->dropColumn('stay_calm');
          $table->dropColumn('help_others');
          $table->dropColumn('doing_things');
          $table->dropColumn('solving_problems');
          $table->dropColumn('do_not_give_up');
          $table->dropColumn('give_compliments');
          $table->dropColumn('do_the_right_thing');
          $table->dropColumn('making_descisions');
          $table->dropColumn('think_before_i_act');
          $table->dropColumn('leader');
          $table->dropColumn('respect');
          $table->dropColumn('good_decisions');
          $table->dropColumn('honest_person');
          $table->dropColumn('importance_of_learning');
          $table->dropColumn('think_about_problems');
          $table->dropColumn('responsible_person');
          $table->dropColumn('work_through_problems');
          $table->dropColumn('set_goals');
          $table->dropColumn('overcome_a_challenge');
          $table->dropColumn('work_well_with_others');
          $table->dropColumn('half_of_value');
          $table->dropColumn('decimal_numbers_represent');
          $table->dropColumn('nfl_kicker');
          $table->dropColumn('free_throws');
          $table->dropColumn('wnba_free_throws');
          $table->dropColumn('same_shots');
          $table->dropColumn('odds_of_three_point');
          $table->dropColumn('shot_odds');
        	$table->string('lebron_james')->nullable();
          $table->string('draft')->nullable();
          $table->string('shooting_percentage')->nullable();
          $table->string('missed_shot')->nullable();
          $table->string('circle_graph')->nullable();
          $table->string('steph_curry')->nullable();
          $table->string('dwight_howard')->nullable();
          $table->string('weight')->nullable();
          $table->string('rookie')->nullable();
          $table->string('grid')->nullable();
        });
    }
}
