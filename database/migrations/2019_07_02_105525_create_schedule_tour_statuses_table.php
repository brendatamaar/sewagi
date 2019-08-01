<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTourStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_tour_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('en_renter_status');
            $table->string('id_renter_status');
            $table->string('en_lister_status');
            $table->string('id_lister_status');
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
        Schema::dropIfExists('schedule_tour_statuses');
    }
}
