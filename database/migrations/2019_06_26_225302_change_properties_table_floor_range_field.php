<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePropertiesTableFloorRangeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        config()->set('database.connections.mysql.strict', false);
        \DB::reconnect(); //important as the existing connection if any would be in strict mode
        \DB::statement("ALTER TABLE properties MODIFY floor_range ENUM('below 5', 'between 5-10', 'above 10') NULL;");
        config()->set('database.connections.mysql.strict', true);
        $a = ['below 5', 'between 5-10', 'above 10'];
        $random_keys = array_rand($a);
        \DB::table('properties')->whereNull('floor_range')->orwhere('floor_range', '')->update(
            [
                'floor_range' => $a[$random_keys]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        config()->set('database.connections.mysql.strict', false);
        \DB::reconnect(); //important as the existing connection if any would be in strict mode
        \DB::statement("ALTER TABLE properties MODIFY floor_range ENUM('below 5', 'beetween 5-10', 'above 10') NULL;");
        $a = ['below 5', 'beetween 5-10', 'above 10'];
        $random_keys = array_rand($a);
        \DB::table('properties')->whereNull('floor_range')->orwhere('floor_range', '')->update(
            [
                'floor_range' => $a[$random_keys]
            ]
        );
        config()->set('database.connections.mysql.strict', true);
    }
}
