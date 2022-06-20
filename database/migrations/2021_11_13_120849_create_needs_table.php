<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('needs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('ws_cat_id')->unsigned()->nullable();
            $table->bigInteger('workstation_id')->unsigned()->nullable();

            $table->string('status')->default('pending');// pending, cancled,approved/
            $table->string('payment_status')->nullable();// advanced, paid
            $table->string('order_status')->nullable();// delivered, satisfied,unsatisfied,cancled
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('satisfied_at')->nullable();
            $table->timestamp('unsatisfied_at')->nullable();
            $table->decimal('order_confirmed_price',12,2)->nullable();//blance transfired from user balance for this order

            
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
        Schema::dropIfExists('needs');
    }
}
