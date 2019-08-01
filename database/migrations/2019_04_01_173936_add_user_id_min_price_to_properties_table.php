<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdMinPriceToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->after('longitude');
            $table->integer('co_living_min_price')->default(0)->after('user_id');
            $table->integer('entire_space_min_price')->default(0)->after('co_living_min_price');
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
            $table->dropColumn('user_id');
            $table->dropColumn('co_living_min_price');
            $table->dropColumn('entire_space_min_price');
        });
    }
}
