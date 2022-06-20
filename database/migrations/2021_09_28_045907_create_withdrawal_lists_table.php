<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_lists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('withdraw_type')->nullable(); //'mobile_recharge','online_banking'
            $table->string('service_type')->nullable(); //'bKash','Nagad','Rocket'
            $table->string('recharge_type')->nullable(); //'Prepaid','Postpaid'
            $table->string('mobile_number')->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->string('paid_type')->nullable(); // manual,online
            $table->string('paid_from_number')->nullable(); // if menual then mobile number else blank
            $table->bigInteger('transaction_id')->unsigned()->nullable();//on update
            $table->string('status')->default('pending'); //pending ,cancelled/paid
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
        Schema::dropIfExists('withdrawal_lists');
    }
}
