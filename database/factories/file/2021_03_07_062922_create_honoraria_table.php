<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHonorariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('honoraria', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->bigInteger('workstation_id')->unsigned()->nullable();

            $table->string('system_type')->nullable();
            //joining //working //wallet
            
            $table->string('earning_type')->nullable();
            //1.signup //(signup commission)
            //2.refferal
            //3.pair
            //4.reward
            //all 4 earning types are for joining income
            
            //5. affiliate
            //6. up
            //7. updown
            //8. team_group
            //9. ws_individual
            //10. all_ws
            //11. lifetime_refer
            //12. incentive
            //13. all_working
            //all 5-13 earning types are for working income
            
            //every option will applied 2 or 3 or multiple time


            $table->integer('commission')->default(0);
            //commission %

            $table->decimal('workorder_upto_amount',10,4)->default(0);
            

            $table->integer('payment_duration')->default(0);
            //in days


            $table->boolean('active')->default(1);

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
        Schema::dropIfExists('honoraria');
    }
}
