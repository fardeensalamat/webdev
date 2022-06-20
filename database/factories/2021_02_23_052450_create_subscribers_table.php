<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                  ->unsigned()
                  ->nullable();
            $table->string('subscription_code')->nullable();
            //pf code
            $table->bigInteger('top_subscriber_id')
                  ->unsigned()
                  ->nullable();
                  // user id
            $table->bigInteger('ws_position')->unsigned()->nullable();
            //work_station_position
            //left right
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->integer('work_station_id') 
                  ->unsigned()
                  ->nullable();
            $table->integer('district_id')
                  ->unsigned()
                  ->nullable();

            $table->decimal('balance',12,2)->default(0);
            // withdrawable balance will transfer in users balance

            $table->bigInteger('referral_id')
                  ->unsigned()
                  ->nullable();
                  //user id
            
            $table->bigInteger('addedby_id')->unsigned()->nullable();
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
        Schema::dropIfExists('subscribers');
    }
}
