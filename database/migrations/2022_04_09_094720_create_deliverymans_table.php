<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverymansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverymans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone',15)->nullable();
            $table->string('email',32)->nullable();
            $table->string('image')->nullable();
            $table->string('nid',20)->nullable();
            $table->string('address')->nullable();
            $table->string('area')->nullable();
            $table->string('about')->nullable();
            $table->string('website')->nullable();
            $table->string('user_id',12)->nullable();
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
        Schema::dropIfExists('deliverymans');
    }
}
