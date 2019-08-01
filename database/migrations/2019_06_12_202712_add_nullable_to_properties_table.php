<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddNullableToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::statement("ALTER TABLE `properties` ALTER COLUMN `title` VARCHAR (255)");
        DB::statement("ALTER TABLE properties MODIFY `title` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `description` TEXT NULL;");
        DB::statement("ALTER TABLE properties MODIFY `address` VARCHAR(2048) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `property_number` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `property_detail` VARCHAR(2048) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `province` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `city` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `district` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `village` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `postcode` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `latitude` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `longitude` VARCHAR(255) NULL;");
        DB::statement("ALTER TABLE properties MODIFY `unit_size` INT;");
        DB::statement("ALTER TABLE properties MODIFY `building_size` INT;");
        DB::statement("ALTER TABLE properties MODIFY land_area_type ENUM('residential', 'non residential') NULL;");
        DB::statement("ALTER TABLE properties MODIFY type ENUM('apartment', 'house') NULL;");
        DB::statement("ALTER TABLE properties MODIFY arrangement ENUM('townhouse', 'standalone') NULL;");
        DB::statement("ALTER TABLE properties MODIFY floor_range ENUM('below 5', 'beetween 5-10', 'above 10') NULL;");
        DB::statement("ALTER TABLE properties MODIFY furniture ENUM('furnished', 'semi-furnished', 'unfurnished') NULL;");
        DB::statement("ALTER TABLE properties MODIFY belong_to ENUM('1', '2', '3') NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Nothing
    }
}
