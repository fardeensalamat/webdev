<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProfileVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_profile_visitors', function (Blueprint $table) {
            $table->id();
            $table->integer('workstation_id')->nullable();
            $table->integer('ws_cat_id')->nullable();
            $table->integer('subscriber_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('service_profile_id')->nullable();
            // $table->integer('personal_profile_id')->nullable(); //visitor profile id
            $table->integer('visit_count')->default(0);
            $table->boolean('free')->default(1);
            $table->boolean('short_paid')->default(0);
            $table->boolean('full_paid')->default(0);
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
        Schema::dropIfExists('service_profile_visitors');
    }
}
