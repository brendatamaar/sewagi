<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCommunity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->unsignedInteger('nationality_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('area_live')->nullable();
            $table->string('area_practice')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('working_field')->nullable();
            $table->string('latest_education')->nullable();
            $table->string('english_spoken')->nullable();
            $table->string('english_written')->nullable();
            $table->string('description')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community');
    }
}
