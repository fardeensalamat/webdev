<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                ->index()
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->string('excerpt')->nullable();
            $table->string('feature_img_name')
                ->nullable();
            $table->text('tags')->nullable(); //for search
            $table->string('categories')->nullable(); //for search
            $table->timestamp('date')->nullable();
            $table->string('publish_status')->default('temp'); //temp, draft, published,/pending
            $table->string('type')->nullable(); //blog, news, event
            $table->integer('addedby_id')
                ->unsigned()
                ->nullable();
            $table->integer('editedby_id')
                ->unsigned()
                ->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
