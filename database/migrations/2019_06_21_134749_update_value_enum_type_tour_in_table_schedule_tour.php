<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateValueEnumTypeTourInTableScheduleTour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasColumn('schedule_tours', 'type_tour')) {
            Schema::table('schedule_tours', function (Blueprint $table) {
                $table->enum('type_tour',['onsite', 'virtual'])->after('price')->nullable();
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
        if (Schema::hasColumn('schedule_tours', 'type_tour')) {
            Schema::table('schedule_tours', function (Blueprint $table) {
                $table->dropColumn('type_tour');
            });
        }
    }
}
