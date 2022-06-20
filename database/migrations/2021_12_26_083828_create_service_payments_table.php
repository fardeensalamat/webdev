<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('service_profile_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('workstation_id')->unsigned()->nullable();
            $table->bigInteger('subscriber_id')->unsigned()->nullable();
            $table->bigInteger('item_id')->unsigned()->nullable();
            $table->bigInteger('negotiation_id')->unsigned()->nullable();
            $table->decimal('order_confirmed_balance',12,2)->default(0.00);
            $table->decimal('final_price',12,2)->default(0.00);
            $table->string('order_status')->nullable(); //pending ,delivered/ confirmed,sutisfied,unsutisfied,canceled
            $table->string('payment_status')->nullable(); //paid,advanced,
            $table->timestamp('pending_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('satisfied_at')->nullable();
            $table->timestamp('un_satisfied_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->integer('addedby_id')->unsigned()->nullable();
            $table->integer('editedby_id')->unsigned()->nullable();
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
        Schema::dropIfExists('service_payments');
    }
}
