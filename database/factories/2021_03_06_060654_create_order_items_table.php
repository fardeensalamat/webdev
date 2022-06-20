<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned()->nullable(); 
            $table->integer('work_station_id')->nullable();
            $table->bigInteger('subscriber_id')
                ->unsigned()->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('order_status')->default('pending');
            
            //pending
            //confirmed
            //processing
            //ready_to_ship
            //shipped
            //delivered
            //cancelled
            //returned
            //undelivered
            $table->bigInteger('itemable_id')->nullable();
            $table->string('itemable_type')->nullable();

            $table->text('extra_description')->nullable();
            //if order cancel or return, details will be here.
            $table->decimal('final_price',10,2)->default(0);

            $table->bigInteger('addedby_id')->unsigned()->nullable(); 
            $table->bigInteger('editedby_id')->unsigned()->nullable();    

            $table->timestamp('pending_at')->nullable(); 
            $table->timestamp('confirmed_at')->nullable(); 
            $table->timestamp('processing_at')->nullable(); 
            $table->timestamp('ready_to_ship_at')->nullable(); 
            $table->timestamp('shipped_at')->nullable(); 
            $table->timestamp('delivered_at')->nullable(); 
            $table->timestamp('cancelled_at')->nullable(); 
            $table->timestamp('returned_at')->nullable(); 
            $table->timestamp('undelivered_at')->nullable(); 

            // $table->timestamp('paid_to_seller_at')->nullable();
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
        Schema::dropIfExists('order_items');
    }
}
