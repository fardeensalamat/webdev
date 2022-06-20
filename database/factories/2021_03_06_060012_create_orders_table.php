<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('work_station_id')->nullable();
            $table->bigInteger('subscriber_id')
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->bigInteger('invoice_number')->nullable();
            //12112056
            $table->char('order_for',10)->default('product');
            //product, balance

            $table->string('order_status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            //unpaid, partial, paid

            $table->decimal('paid_amount',10,2)->default(0);
            $table->decimal('due_amount',10,2)->default(0);
            $table->bigInteger('addedby_id')->unsigned()->nullable(); 
            $table->bigInteger('editedby_id')->unsigned()->nullable();

            $table->timestamp('distributed_at')->nullable();

            $table->timestamp('pending_at')->nullable(); 
            $table->timestamp('confirmed_at')->nullable(); 
            $table->timestamp('processing_at')->nullable(); 
            $table->timestamp('ready_to_ship_at')->nullable(); 
            $table->timestamp('shipped_at')->nullable(); 
            $table->timestamp('delivered_at')->nullable(); 
            $table->timestamp('cancelled_at')->nullable(); 
            $table->timestamp('returned_at')->nullable(); 
            $table->timestamp('undelivered_at')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
