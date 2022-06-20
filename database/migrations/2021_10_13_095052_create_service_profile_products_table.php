<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProfileProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_profile_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_profile_id')->unsigned()->nullable();
            $table->bigInteger('workstation_id')->unsigned()->nullable();
            $table->bigInteger('ws_cat_id')->unsigned()->nullable();
            $table->bigInteger('subscriber_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('purchase_price',12,2)->nullable();
            $table->decimal('deleted_price',12,2)->nullable();
            $table->decimal('sale_price',12,2)->nullable();
            $table->string('feature_image_name')->nullable();
            $table->string('status')->nullable();
			$table->boolean('home_delivery')->default(1);
			$table->boolean('online_sale')->default(0);
			$table->boolean('offline_sale')->default(0);
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('service_profile_products');
    }
}
