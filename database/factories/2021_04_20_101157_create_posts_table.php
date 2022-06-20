<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('subscriber_id')->unsigned()->nullable(); //subscriber_id
            $table->bigInteger('postable_id')->unsigned()->nullable();
            $table->string('postable_type')->nullable();

            $table->json('title')->nullable();
            $table->json('description')->nullable();
            $table->json('excerpt')->nullable();
            $table->integer('workstation_id')->unsigned()->nullable();
            $table->integer('ws_cat_id')->unsigned()->nullable();
            $table->string('publish_status')->default('temp');
            // temp, draft, published
            $table->integer('read')->unsigned()->nullable();
            // total read count
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
        Schema::dropIfExists('posts');
    }
}