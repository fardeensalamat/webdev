<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProfileInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_profile_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('work_station_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('profile_info_key')->nullable();
            $table->string('field_type')->nullable();
            $table->string('access_type')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('profile_card_display')->default(1);

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
        Schema::dropIfExists('service_profile_infos');
    }
}
