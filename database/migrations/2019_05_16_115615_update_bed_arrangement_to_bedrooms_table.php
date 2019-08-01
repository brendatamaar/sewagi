<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBedArrangementToBedroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE bedrooms MODIFY bed_arrangement ENUM('twin', 'single', 'queen', 'king') NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE bedrooms MODIFY bed_arrangement ENUM('twin', 'single', 'queen', 'king') NOT NULL;");
    }
}
