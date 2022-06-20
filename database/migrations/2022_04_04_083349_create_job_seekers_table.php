<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name')->nullable()->index();
            $table->string('skill')->nullable();
            $table->string('email', 32)->nullable()->index();
            $table->string('mobile', 32)->nullable()->index();
            $table->string('image')->nullable();
            $table->string('agree')->nullable();
            $table->string('is_user')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->date('dob')->nullable();
            $table->string('religion')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('national_id')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->string('phone2')->nullable();
            $table->string('email2')->nullable();
            $table->string('econtact')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('pre_bangladesh_status')->nullable();
            $table->string('pre_district')->nullable();
            $table->string('pre_thana')->nullable();
            $table->string('pre_po')->nullable();
            $table->text('pre_address')->nullable();
            $table->string('per_bangladesh_status')->nullable();
            $table->string('per_district')->nullable();
            $table->string('per_thana')->nullable();
            $table->string('per_po')->nullable();
            $table->text('per_address')->nullable();
            $table->text('objective')->nullable();
            $table->integer('present_salary')->nullable();
            $table->integer('expexted_salary')->nullable();
            $table->string('job_level')->nullable();
            $table->string('available_for')->nullable();
            $table->string('job_cat_fun1')->nullable();
            $table->string('job_cat_fun2')->nullable();
            $table->string('job_cat_fun3')->nullable();
            $table->string('job_cat_sp1')->nullable();
            $table->string('job_cat_sp2')->nullable();
            $table->string('job_cat_sp3')->nullable();
            $table->text('career_summary')->nullable();
            $table->text('special_qualification')->nullable();
            $table->text('keywords')->nullable();
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
        Schema::dropIfExists('job_seekers');
    }
}
