<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreassessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preassessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('nba_champion')->unsigned();
            $table->integer('try_hard')->unsigned();
            $table->integer('complete_assignments')->unsigned();
            $table->integer('scare')->unsigned();
            $table->integer('rarely_use')->unsigned();
            $table->integer('give_up')->unsigned();
            $table->integer('future_work')->unsigned();
            $table->integer('math_related_activities')->unsigned();
            $table->integer('competitive')->unsigned();
            $table->integer('respectful')->unsigned();         
            $table->integer('7+1')->unsigned()->nullable();
            $table->integer('6-3')->unsigned()->nullable();
            $table->integer('6x6')->unsigned()->nullable();
            $table->integer('9/3')->unsigned()->nullable();
            $table->integer('7+5')->unsigned()->nullable();
            $table->integer('9x0')->unsigned()->nullable();
            $table->integer('7x7')->unsigned()->nullable();
            $table->integer('7-1')->unsigned()->nullable();
            $table->integer('4x5')->unsigned()->nullable();
            $table->integer('9/2')->unsigned()->nullable();
            $table->integer('8x7')->unsigned()->nullable();
            $table->integer('8-8')->unsigned()->nullable();
            $table->integer('5/2')->unsigned()->nullable();
            $table->integer('7x9')->unsigned()->nullable();
            $table->integer('4+3')->unsigned()->nullable();
            $table->integer('6+5')->unsigned()->nullable();
            $table->integer('9-7')->unsigned()->nullable();
            $table->integer('2x8')->unsigned()->nullable();
            $table->integer('7/1')->unsigned()->nullable();
            $table->integer('9-1')->unsigned()->nullable();
            $table->integer('6/2')->unsigned()->nullable();
            $table->integer('5x2')->unsigned()->nullable();
            $table->integer('8/2')->unsigned()->nullable();
            $table->integer('3x4')->unsigned()->nullable();
            $table->integer('8-7')->unsigned()->nullable();
            $table->integer('5x8')->unsigned()->nullable();
            $table->integer('1x1')->unsigned()->nullable();
            $table->integer('10/3')->unsigned()->nullable();
            $table->integer('9+8')->unsigned()->nullable();
            $table->integer('3-2')->unsigned()->nullable();
            $table->integer('steph_curry')->unsigned()->nullable(); 
            $table->integer('dwight_howard')->unsigned()->nullable(); 
            $table->integer('weight')->unsigned()->nullable(); 
            $table->integer('rookie')->unsigned()->nullable(); 
            $table->integer('grid')->unsigned()->nullable();
            $table->integer('lebron_james')->unsigned()->nullable(); 
            $table->integer('draft')->unsigned()->nullable(); 
            $table->integer('shooting_percentage')->unsigned()->nullable(); 
            $table->integer('missed_shot')->unsigned()->nullable(); 
            $table->integer('circle_graph')->unsigned()->nullable();
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
        Schema::dropIfExists('preassessments');
    }
}
