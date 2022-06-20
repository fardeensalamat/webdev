<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courseitems', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('service_profile_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('workstation_id')->unsigned()->nullable();
            $table->bigInteger('subscriber_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('ins_name')->nullable();
            $table->longText('ins_designation')->nullable();
            $table->longText('whatlearn')->nullable();
            $table->longText('aboutcourse')->nullable();
            $table->longText('coursesyllabus')->nullable();
            $table->longText('hoursdetails')->nullable();
            $table->decimal('price',12,2)->default(0.00);
            $table->boolean('negotiations')->default(0);
            $table->string('courselink')->nullable();
            $table->string('courseimage')->nullable();
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
        Schema::dropIfExists('courseitems');
    }
}
