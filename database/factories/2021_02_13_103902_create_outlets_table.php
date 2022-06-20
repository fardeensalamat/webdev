<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id') //own id or other id
                  ->unsigned()
                  ->nullable();
            $table->integer('drag_id')->nullable();
            $table->integer('thana_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('division_id')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('address')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('code')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->bigInteger('addedby_id') 
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('editedby_id') 
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
        Schema::dropIfExists('outlets');
    }
}
