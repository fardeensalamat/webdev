<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_works', function (Blueprint $table) {
            
            $table->id();

            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->bigInteger('order_item_id')->unsigned()->nullable();
            $table->bigInteger('workstation_id')->unsigned()->nullable();
            $table->bigInteger('subscriber_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->bigInteger('order_itemable_id')->unsigned()->nullable();
            $table->string('order_itemable_type')->nullable();

            $table->string('status')->default('pending');
            //pending, accepted, rejected
            
            $table->text('job_owner_note')->nullable();
            //the cause of rejection
            
            $table->text('admin_note')->nullable();
            //to job owner and to subscriber
            
            $table->decimal('amount', 10,4)->default(0);

            $table->boolean('completed')->default(0);
            //accepted or rejected and payment delivered or not
            
            $table->timestamp('review_expired_at')->nullable();
            //auto status will accepted after review_expired_at and payment will be delivered and completed will true.

            $table->timestamp('payment_delivered_at')->nullable();
            //payment delivered to accounts or honorariums...            

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
        Schema::dropIfExists('order_works');
    }
}
