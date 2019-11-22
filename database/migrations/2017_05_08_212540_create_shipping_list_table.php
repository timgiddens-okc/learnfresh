<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item')->default('48822');
            $table->integer('quantity')->unsigned();
            $table->string('recipient');
            $table->string('company');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('post_code');
            $table->string('country')->default("USA");
            $table->string('phone')->nullable();
            $table->string('ship_method')->default("FedEx Ground");
            $table->string('recipient_email')->nullable();
            $table->string('sender_email')->default("jeff@learnfresh.org");
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
        Schema::dropIfExists('shipping');
    }
}
