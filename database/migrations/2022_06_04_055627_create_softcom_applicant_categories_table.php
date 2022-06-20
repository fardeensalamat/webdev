<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftcomApplicantCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softcom_applicant_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('service_charge')->nullable();
            $table->string('salary_type')->nullable();
            $table->string('type')->nullable();
            $table->string('salary_amount')->nullable();
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
        Schema::dropIfExists('softcom_applicant_categories');
    }
}
