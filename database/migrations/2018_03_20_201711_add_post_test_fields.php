<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostTestFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postassessments', function (Blueprint $table) {
            $table->integer('math_hoops_games')->unsigned()->nullable();
            $table->integer('worksheets')->unsigned()->nullable();
            $table->integer('math_more_fun')->unsigned()->nullable();
            $table->integer('confident')->unsigned()->nullable();
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
            $table->dropColumn('math_hoops_games');
            $table->dropColumn('worksheets');
            $table->dropColumn('math_more_fun');
            $table->dropColumn('confident');
        });
    }
}
