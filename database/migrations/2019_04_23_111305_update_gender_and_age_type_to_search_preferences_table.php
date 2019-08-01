<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGenderAndAgeTypeToSearchPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('search_preferences', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('age');
            $table->boolean('is_mostly_male')->default(0)->after('user_id');
            $table->boolean('is_mostly_female')->default(0)->after('is_mostly_male');
            $table->integer('min_age')->after('from');
            $table->integer('max_age')->after('min_age');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('search_preferences', function (Blueprint $table) {
            $table->enum('gender', ['M', 'F'])->after('user_id');
            $table->integer('age')->after('from');
            $table->dropColumn('is_mostly_male');
            $table->dropColumn('is_mostly_female');
            $table->dropColumn('min_age');
            $table->dropColumn('max_age');
        });
    }
}
