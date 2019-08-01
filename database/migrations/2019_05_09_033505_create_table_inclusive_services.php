<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInclusiveServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inclusive_services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('internet')->default(0);
            $table->boolean('private_parking')->default(0);
            $table->boolean('tv_cable')->default(0);
            $table->boolean('cleaning_service')->default(0);
            $table->boolean('charge_fee')->default(0);
            $table->integer('entire_space_price');
            $table->integer('co_living_price');
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
        Schema::dropIfExists('inclusive_services');
    }
}
