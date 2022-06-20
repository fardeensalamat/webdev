<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('drag_id')->unsigned()->nullable();
            $table->string('name')->nullable()->index();
            $table->string('description')->nullable();
            $table->string('img_name')->nullable();
            $table->string('banner_name')->nullable();
            $table->integer('work_station_id')->nullable();
            //title and description in localeable table
            
            $table->boolean('active')->default(1);
            $table->boolean('featured')->default(0);
            
            $table->bigInteger('addedby_id') //own id or other id
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('editedby_id') //own id or other id
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
        Schema::dropIfExists('categories');
    }
}
