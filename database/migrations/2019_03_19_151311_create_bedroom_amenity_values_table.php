<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedroomAmenityValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bedroom_amenity_values', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bedroom_id');
            $table->foreign('bedroom_id')->references('id')->on('bedrooms')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('bedroom_amenity_id');
            $table->foreign('bedroom_amenity_id')->references('id')->on('bedroom_amenities')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('bedroom_amenity_values');
    }
}
