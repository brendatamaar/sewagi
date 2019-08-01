<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstimatedPriceToProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasColumn('properties', 'estimated_price')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->bigInteger('estimated_price')->nullable()->after('total_room');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('properties', 'estimated_price')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->dropColumn( 'estimated_price');
            });
        }
    }
}
