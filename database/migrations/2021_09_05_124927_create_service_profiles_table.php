<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('workstation_id')->unsigned()->nullable();
            $table->integer('ws_cat_id')->unsigned()->nullable();
            $table->bigInteger('subscriber_id')
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('name')->nullable()->index();
            $table->string('email', 32)->nullable()->index();
            $table->string('mobile', 32)->nullable()->index();
            $table->string('img_name')->nullable();
            $table->text('address')->nullable();
            $table->text('short_bio')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->boolean('status')->nullable();
			$table->boolean('open')->deafult(0);
			$table->string('package_status')->deafult('free'); // free, regular, marchent, gold
            
            $table->string('profile_type')->nullable(); //business //personal
            $table->integer('addedby_id')->unsigned();
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
        Schema::dropIfExists('service_profiles');
    }
}
