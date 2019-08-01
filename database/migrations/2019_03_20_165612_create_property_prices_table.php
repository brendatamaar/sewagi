<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('living_condition', ['co-living', 'entire-space']);
            $table->tinyInteger('is_include_internet')->default(0);
            $table->tinyInteger('is_include_park')->default(0);
            $table->tinyInteger('is_include_tv_cable')->default(0);
            $table->tinyInteger('is_include_cleaning')->default(0);
            $table->integer('service_fee');
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
        Schema::dropIfExists('property_prices');
    }
}
