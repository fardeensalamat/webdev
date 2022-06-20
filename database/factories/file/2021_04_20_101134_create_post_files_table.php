<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id');
            $table->string('file_name')->nullable();        
            $table->string('original_name')->nullable();        
            $table->string('file_mime')->nullable();        
            $table->string('file_size')->nullable();        
            $table->string('file_ext')->nullable();        
            $table->string('file_type')->nullable();        
            // pfg, jpg, video
            $table->bigInteger('addedby_id')->unsigned();
            $table->bigInteger('editedby_id')->unsigned()->nullable();
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
        Schema::dropIfExists('post_files');
    }
}
