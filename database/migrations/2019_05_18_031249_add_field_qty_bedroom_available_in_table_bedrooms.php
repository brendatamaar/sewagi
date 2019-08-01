<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldQtyBedroomAvailableInTableBedrooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bedrooms', function (Blueprint $table) {
            $table->integer('quantity_available')->after('quantity');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bedrooms', function (Blueprint $table) {
            $table->dropColumn('quantity_available');
        });
    }
}
