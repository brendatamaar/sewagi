<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemarksToScheduleToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_tours', function (Blueprint $table) {
            $table->boolean('is_property_available')->nullable()->after('type_tour');
            $table->unsignedInteger('confirmed_tour_id')->nullable()->after('is_property_available');
            $table->date('property_available_at')->nullable()->after('confirmed_tour_id');
            $table->boolean('is_property_indefinitely')->nullable()->after('property_available_at');
            $table->boolean('is_reschedule_tour')->nullable()->default(0)->after('is_property_indefinitely');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_tours', function (Blueprint $table) {
            $table->dropColumn('is_property_available');
            $table->dropColumn('confirmed_tour_id');
            $table->dropColumn('property_available_at');
            $table->dropColumn('is_property_indefinitely');
            $table->dropColumn('is_reschedule_tour');
        });
    }
}
