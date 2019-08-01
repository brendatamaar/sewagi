<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChargeFeeToPropertyPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_prices', function (Blueprint $table) {
            $table->boolean('charge_fee')->default(false)->after('service_fee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_prices', function (Blueprint $table) {
            $table->dropColumn('charge_fee');
        });
    }
}
