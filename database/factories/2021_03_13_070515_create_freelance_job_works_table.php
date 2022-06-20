<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelanceJobWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelance_job_works', function (Blueprint $table) {
            $table->id();
            $table->integer('work_station_id')->nullable();
            $table->bigInteger('subscriber_id')
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('user_id')
                ->unsigned()->nullable();
            $table->bigInteger('freelancer_job_id')
                ->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('require_details')->nullable();
            $table->string('img')->nullable();
            $table->string('status')->default('pending');
            $table->text('job_owner_note')->nullable();
            //the cause of rejection
            $table->text('admin_note')->nullable();
            //to job owner and to subscriber

            
            $table->timestamp('distributed_at')->nullable(); 

            //pending
            //approved
            //rejected
            $table->timestamp('pending_at')->nullable(); 
            $table->timestamp('approved_at')->nullable(); 
            $table->timestamp('rejected_at')->nullable(); 
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
        Schema::dropIfExists('freelance_job_works');
    }
}
