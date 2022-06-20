<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courseorders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('service_profile_id')->unsigned()->nullable();
            $table->bigInteger('ws_cat_id')->unsigned()->nullable();
            $table->bigInteger('workstation_id')->unsigned()->nullable();
            $table->integer('total_quantity')->nullable();
            $table->decimal('order_confirmed_price',12,2)->nullable();//blance transfired from user balance for this order
            
            $table->string('transection_id')->nullable(); //auto generate by date
            $table->string('payment_status')->nullable(); //advance, Full Paid, Partial paid
            $table->string('order_status')->nullable(); // pending,, cancelled confirmed,returned,ready_to_ship,shipped,delivered,satisfied,unsatisfied
            $table->bigInteger('course_id')->unsigned()->nullable();
            $table->bigInteger('course_profile_id')->unsigned()->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('delivery_address')->nullable();
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
        Schema::dropIfExists('courseorders');
    }
}
