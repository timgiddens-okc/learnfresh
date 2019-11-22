<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReleaseFormAndParticipationCertificateToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
          $table->string("release_form")->nullable();
          $table->string("participation_certificate")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    if(Schema::hasColumn('events', 'release_form')){
        Schema::table('events', function (Blueprint $table) {
          $table->dropColumn("release_form");
        });
      }
      
      if(Schema::hasColumn('events', 'participation_certificate')){
        Schema::table('events', function (Blueprint $table) {
          $table->dropColumn("participation_certificate");
        });
      }
    }
}
