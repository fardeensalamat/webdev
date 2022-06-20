<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancer_jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('work_station_id')->nullable();
            $table->bigInteger('subscriber_id')
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('img_name')->nullable();
            $table->integer('total_worker')->unsigned()->nullable();
            $table->integer('work_done')->unsigned()->nullable();
            //pending + approved job works count
            
            $table->decimal('job_post_price', 10,4)->nullable();
            $table->decimal('job_work_price', 10,4)->nullable();
            // $table->decimal('per_worker_cost',12,3)->unsigned()->nullable();
            $table->decimal('total_job_post_cost',12,3)->unsigned()->nullable();
            //tjpc = job_post_price*total_worker(decimanl)
            $table->decimal('total_job_work_cost',12,3)->unsigned()->nullable();
            //tjwc = job_work_price*total_worker
            $table->date('expired_day')->nullable(); 
            $table->string('status')->nullable();
            //null, temp (pending job post), completed , 
            // null(show to all), cancel
            
            $table->integer('admin_given_workers')->unsigned()->nullable();
            // admin given total worker
            $table->string('admin_completed_status')->nullable(); 
            // completed // incomplete
            $table->string('admin_custom_job_status')->nullable(); // custom job


            $table->integer('addedby_id')
            ->unsigned();
            $table->integer('editedby_id')
            ->unsigned()
            ->nullable();
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
        Schema::dropIfExists('freelancer_jobs');
    }
}
