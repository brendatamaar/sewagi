<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyPriceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_price_details', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('length', ['12', '9', '6', '3']);
            $table->integer('bedroom_id');
            $table->integer('paid_once')->nullable();
            $table->integer('paid_twice')->nullable();
            $table->integer('paid_quarterly')->nullable();
            $table->integer('paid_monthly')->nullable();
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
        Schema::dropIfExists('property_price_details');
    }
}
