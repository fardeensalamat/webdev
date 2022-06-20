<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviceitems', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('service_profile_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('workstation_id')->unsigned()->nullable();
            $table->bigInteger('subscriber_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price',12,2)->default(0.00);
            $table->boolean('negotiations')->default(0);
            $table->integer('addedby_id')->unsigned()->nullable();
            $table->integer('editedby_id')->unsigned()->nullable();
            $table->string('status')->default('pending'); //pending,approved,cancled
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('serviceitems');
    }
}
