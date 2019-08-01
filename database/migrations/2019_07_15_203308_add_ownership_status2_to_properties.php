<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnershipStatus2ToProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasColumn('properties', 'ownership_status')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->enum('ownership_status', ['1', '2'])->nullable()->after('belong_to');
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
        if (Schema::hasColumn('properties', 'ownership_status')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->dropColumn( 'ownership_status');
            });
        }
    }
}
