<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScheduleTourOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_tour_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('schedule_tour_id');
            $table->foreign('schedule_tour_id')->references('id')->on('schedule_tours')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('time')->nullable();
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
        Schema::dropIfExists('schedule_tour_options');
    }
}
