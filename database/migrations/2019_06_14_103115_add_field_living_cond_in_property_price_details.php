<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldLivingCondInPropertyPriceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_price_details', function (Blueprint $table) {
            $table->enum('living_cond',['co-living', 'entire_space']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_price_details', function (Blueprint $table) {
            $table->dropColumn('living_cond');
        });
    }
}
