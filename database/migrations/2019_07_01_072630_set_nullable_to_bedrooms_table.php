<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullableToBedroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `bedrooms` MODIFY `type` ENUM('master', 'standard', 'pocket') NULL;");
        DB::statement("ALTER TABLE `bedrooms` MODIFY `size` INT(11) NULL;");
        DB::statement("ALTER TABLE `bedrooms` MODIFY `quantity` INT(11) NULL;");
        DB::statement("ALTER TABLE `bedrooms` MODIFY `quantity_available` INT(11) NULL;");
        DB::statement("ALTER TABLE `bedrooms` MODIFY `furniture` ENUM('furnished', 'semi-furnished', 'unfurnished') NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bedrooms', function (Blueprint $table) {
            //
        });
    }
}
