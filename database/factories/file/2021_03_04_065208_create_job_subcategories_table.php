<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_subcategories', function (Blueprint $table) {
            $table->id();
            $table->integer('job_category_id')->unsigned()->nullable();
            $table->string('title')->nullable()->index();
            $table->decimal('job_post_price', 10,4)->nullable();
            $table->decimal('job_work_price', 10,4)->nullable();
            $table->string('description')->nullable();
            $table->integer('screenshot')->default(1);
            //1 or 2; number of screenshot

            $table->boolean('admin_approve')->default(0);
            //0 ->auto approve , 1 -> admin appove
            
            $table->bigInteger('addedby_id') //own id or other id
                  ->unsigned()
                  ->nullable();
            $table->bigInteger('editedby_id') //own id or other id
                  ->unsigned()
                  ->nullable();
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
        Schema::dropIfExists('job_subcategories');
    }
}
