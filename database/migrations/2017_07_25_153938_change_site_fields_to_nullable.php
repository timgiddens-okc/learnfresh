<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSiteFieldsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
	        $table->string('name')->nullable()->change();
	        $table->string('phone')->nullable()->change();
          $table->string('school_program_name')->nullable()->change();
          $table->string('shipping_address_1')->nullable()->change();
          $table->string('shipping_city')->nullable()->change();
          $table->string('shipping_state')->nullable()->change();
          $table->string('shipping_zip_code')->nullable()->change();
          $table->string('favorite_team')->nullable()->change();
          $table->integer('first_year')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
