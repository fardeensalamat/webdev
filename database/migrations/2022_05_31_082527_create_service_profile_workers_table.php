<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProfileWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_profile_workers', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id')->nullable();
            $table->integer('profile_id')->nullable();
            $table->integer('worker_id')->nullable();
            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->integer('order')->nullable();
            $table->integer('order_change')->nullable();
            $table->integer('order_details')->nullable();
            $table->integer('customer_list')->nullable();
            $table->integer('add')->nullable();
            $table->integer('edit')->nullable();
            $table->integer('delete')->nullable();
            $table->integer('list')->nullable();
            $table->date('sdate')->nullable();
            $table->date('edate')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('service_profile_workers');
    }
}
