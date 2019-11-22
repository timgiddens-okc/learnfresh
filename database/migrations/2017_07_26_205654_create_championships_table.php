<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChampionshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('championships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->nullable();
            $table->string('location')->nullable();
            $table->text('video')->nullable();
            $table->text('how_to_qualify')->nullable();
            $table->string('qualify_image')->nullable();
            $table->text('event_details')->nullable();
            $table->string('event_details_image')->nullable();
            $table->integer('display')->unsigned()->default(0);
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
        Schema::dropIfExists('championships');
    }
}
