<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_balances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('work_station_id')
                ->unsigned()->nullable();
            $table->decimal('previous_balance',12,2)->default(0);
            $table->decimal('transfer_balance',12,2)->default(0);
            $table->decimal('new_balance',12,2)->default(0);
            $table->string('type')->nullable();

            // order_base_payment
            // softcode_balance
            // withdraw
            // diposit

            // joining
            // joining_reward
            // joining_signup
            // joining_referal
            // joining_pair

            // softcode_up
            // softcode_updown
            // softcode_affiliate
            // softcode_team_group
            // softcode_ws_individual
            // softcode_all_ws
            // softcode_lifetime_refer
            // softcode_incentive
            // softcode_all_working



            // $table->decimal('joining', 14,4)->default(0);
            // //joining balance remaining after calculation and distribution
            
            // $table->decimal('reward', 14,4)->default(0);
            // //reward balance remaining after calculation and distribution

            // $table->decimal('deposit', 14,4)->default(0);
            // //only for total deposit (by various way) status

            // $table->decimal('withdraw', 14,4)->default(0);
            // //only for total withdraw (by various way) status

            // $table->decimal('order', 14,4)->default(0);
            // //order balance remaining after calculation and distribution
            $table->boolean('last')->default(0);
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
        Schema::dropIfExists('admin_balances');
    }
}
