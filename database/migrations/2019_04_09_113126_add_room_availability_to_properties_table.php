<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoomAvailabilityToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->integer('available_room')->default(0)->after('bathrooms');
            $table->integer('rented_room')->default(0)->after('available_room');
            $table->integer('total_room')->default(0)->after('rented_room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('available_room');
            $table->dropColumn('rented_room');
            $table->dropColumn('total_room');
        });
    }
}
