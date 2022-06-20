<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcriberPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcriber_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                  ->unsigned()
                  ->nullable();
            $table->integer('work_station_id') 
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('refer_id')
                  ->unsigned()
                  ->nullable();

            $table->bigInteger('cat_id')
                  ->unsigned()
                  ->nullable();
                  
            $table->decimal('amount',12,2)->default(0);
            $table->integer('district_id')
                ->unsigned()
                ->nullable();
            $table->string('transaction_no')
                ->nullable();
            $table->string('sender_no')
                ->nullable();
            $table->string('receiver_no')
                ->nullable();
            $table->string('status')->nullable(); //for ssl
            //pending, paid

            $table->bigInteger('paidby_id')
                  ->unsigned()->nullable();

            $table->timestamp('distributed_at')->nullable();
            //for distribute the honoraria on upers and followers...

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
        Schema::dropIfExists('subcriber_payments');
    }
}
