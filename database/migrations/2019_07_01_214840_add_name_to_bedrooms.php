<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameToBedrooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasColumn('bedrooms', 'name')) {
            Schema::table('bedrooms', function (Blueprint $table) {
                $table->string('name')->nullable()->after('type');
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
        if (Schema::hasColumn('bedrooms', 'name')) {
            Schema::table('bedrooms', function (Blueprint $table) {
                $table->dropColumn( 'name');
            });
        }
    }
}
