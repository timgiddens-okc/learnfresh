<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProgramAndStateFieldToPostassessments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postassessments', function (Blueprint $table) {
            $table->string('school_program_name')->nullable();
            $table->string('state')->nullable();
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
            $table->dropColumn('school_program_name');
            $table->dropColumn('state');
        });
    }
}
