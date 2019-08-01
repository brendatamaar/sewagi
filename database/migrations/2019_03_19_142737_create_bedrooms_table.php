<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bedrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('type', ['master', 'standard', 'pocket']);
            $table->string('name')->nullable();
            $table->integer('size');
            $table->integer('quantity');
            $table->enum('furniture', ['furnished', 'semi-furnished', 'unfurnished']);
            $table->boolean('is_loft')->default(0);
            $table->enum('bed_arrangement', ['twin', 'single', 'queen', 'king']);
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
        Schema::dropIfExists('bedrooms');
    }
}
