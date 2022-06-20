<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('description')
                  ->nullable();
            $table->bigInteger('commentable_id')
                  ->unsigned();
            $table->string('commentable_type');
            $table->bigInteger('addedby_id')
                  ->unsigned();
            $table->bigInteger('editedby_id')
                  ->unsigned()
                  ->nullable()
                  ->default(NULL);
            $table->boolean('verified')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
