<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAnnouncersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_announcers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('user_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_bnname')->nullable();
            $table->string('is_entrepreneur')->nullable();
            $table->string('year_of_est',10)->nullable();
            $table->string('company_size')->nullable();
            $table->string('country')->nullable();
            $table->string('distric')->nullable();
            $table->string('thana')->nullable();
            $table->string('address')->nullable();
            $table->string('bn_address')->nullable();
            $table->string('industry_type')->nullable();
            $table->integer('industry_category')->nullable();
            $table->string('business_description')->nullable();
            $table->string('license_no')->nullable();
            $table->string('rl_no')->nullable();
            $table->string('web_url')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_designation')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('contact_person_mobile')->nullable();
            $table->string('is_agree')->nullable();
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
        Schema::dropIfExists('job_announcers');
    }
}
