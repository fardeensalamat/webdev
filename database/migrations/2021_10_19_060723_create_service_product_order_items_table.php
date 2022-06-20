<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProductOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_product_order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('service_product_order_id')->unsigned()->nullable();
            $table->bigInteger('service_product_id')->unsigned()->nullable();
            $table->bigInteger('service_profile_id')->unsigned()->nullable();
            $table->bigInteger('ws_cat_id')->unsigned()->nullable();
            $table->bigInteger('workstation_id')->unsigned()->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('purchase_price',12,2)->nullable();
            $table->decimal('sale_price',12,2)->nullable();
            $table->decimal('total_purchase_price',12,2)->nullable(); // purchase_price * quantity
            $table->decimal('total_sale_price',12,2)->nullable(); // sale_price * quantity
            $table->string('order_status')->nullable(); // pending,, cancelled confirmed,returned,ready_to_ship,shipped,delivered,satisfied,unsatisfied
            $table->timestamp('pending_at')->nullable(); 
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('ready_to_ship_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('satisfied_at')->nullable();
            $table->timestamp('unsatisfied_at')->nullable();
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
        Schema::dropIfExists('service_product_order_items');
    }
}
