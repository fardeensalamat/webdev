<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->morphs('model');
            $table->string('file_name')
                  ->nullable();
            $table->string('file_original_name')
                  ->nullable();
            $table->string('file_mime')
                  ->nullable();
            $table->string('file_ext')
                  ->nullable();
            $table->string('file_size')
                  ->nullable();
            $table->string('file_type')
                  ->nullable(); //image, video, 
            $table->string('width')
                  ->nullable(); //for image,
            $table->string('height')
                  ->nullable(); //for image
            $table->string('file_url')
                  ->nullable();
            $table->integer('addedby_id')
                  ->unsigned()
                  ->nullable();
            $table->integer('editedby_id')
                  ->unsigned()
                  ->nullable();
            $table->string('collection_name')->nullable();
            $table->string('disk')->default('public');

            $table->nullableTimestamps();
        });
    }
}
