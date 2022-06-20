<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftcomJobCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softcom_job_candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile',15)->nullable();
            $table->integer('nid')->nullable();
            $table->string('nid_image')->nullable();
            $table->string('candidate_image')->nullable();
            $table->string('description')->nullable();
            $table->string('qualification')->nullable();
            $table->integer('limit')->nullable();
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
        Schema::dropIfExists('softcom_job_candidates');
    }
}
