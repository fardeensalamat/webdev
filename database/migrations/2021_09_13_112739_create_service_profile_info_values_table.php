<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProfileInfoValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_profile_info_values', function (Blueprint $table) {
            $table->id();
            $table->integer('workstation_id')->nullable();
            $table->integer('ws_cat_id')->nullable();
            $table->integer('subscriber_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('service_profile_id')->nullable();
            $table->integer('service_profile_info_id')->nullable();

            $table->string('profile_info_key')->nullable();
            $table->string('field_type')->nullable();
            $table->string('access_type')->nullable();
            $table->boolean('profile_card_display')->default(1);

            $table->text('profile_info_value')->nullable();
            $table->boolean('active')->nullable(0);
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
        Schema::dropIfExists('service_profile_info_values');
    }
}
