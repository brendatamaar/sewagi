<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('size');
            $table->string('mime_type');
            $table->string('file_name', 500);
            $table->string('path', 500);
            $table->integer('height');
            $table->integer('width');
            $table->integer('parent_id')->nullable();
            $table->enum('thumbnail', ['original', 'large', 'medium', 'thumb']);
            $table->morphs('imagable');
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
        Schema::dropIfExists('images');
    }
}
