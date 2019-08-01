<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['apartment', 'house'])->nullable();
            $table->integer('unit_size')->nullable();
            $table->integer('building_size')->nullable();
            $table->tinyInteger('is_co_living')->default(0);
            $table->tinyInteger('is_entire_space')->default(0);
            $table->integer('bedrooms')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->enum('land_area_type', ['residential', 'non residential'])->nullable();
            $table->enum('arrangement', ['townhouse', 'standalone'])->nullable();
            $table->enum('floor_range', ['below 5', 'beetween 5-10', 'above 10'])->nullable();
            $table->boolean('is_pet_friendly')->default(0);
            $table->string('address', 2048)->nullable();
            $table->string('property_number', 255)->nullable();
            $table->string('property_detail', 2048)->nullable();
            $table->string('province', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('district', 255)->nullable();
            $table->string('village', 255)->nullable();
            $table->string('postcode', 255)->nullable();
            $table->string('latitude', 255)->nullable();
            $table->string('longitude', 255)->nullable();
            $table->enum('furniture', ['furnished', 'semi-furnished', 'unfurnished'])->nullable();
            $table->enum('belong_to', ['1', '2', '3'])->nullable();
            $table->tinyInteger('status')->default(0);
            $table->boolean('is_insured')->default(0);
            $table->boolean('is_draft')->default(0);
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
