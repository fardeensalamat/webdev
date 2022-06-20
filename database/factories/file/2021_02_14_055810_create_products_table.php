<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable(); 
            //product owner
            $table->json('name')->nullable();
            //json for multilanguage 
            $table->json('excerpt')->nullable();
            $table->json('description')->nullable();
            
            // $table->boolean('septic')->default(0);
            //পচনশীল 
            // $table->boolean('liquid')->default(0);
            // $table->boolean('inflammable')->default(0);
            //দাহ্য পদার্থ
            $table->boolean('pre_order')->default(0);
            //pre_booking
            $table->boolean('digital')->default(0);
            //downloadable product
            
            $table->boolean('refundable')->default(1);
            
            $table->string('status')->nullable();
            //temp, pending (created by agent and pending for dealer), verified by agent, modified by agent, modified by dealer, published, cancelled by dealer
            $table->bigInteger('brand_id')->unsigned()->nullable();
            
            
            $table->date('publish_date')->nullable();
            $table->date('close_date')->nullable();
            //lead expired and hide from cp, can be increased
            $table->date('mfg_date')->nullable();
            //mfg_date or packed date
            $table->date('exp_date')->nullable();
            //expired date is date for product expired
            $table->string('feature_img')->nullable();
            //also feature image will be in media-gallery
            
            // $table->integer('quantity')->nullable();
            //if null, in stock;
            // $table->integer('min_order_quantity')->nullable();
            // $table->integer('max_order_quantity')->nullable();
            $table->decimal('purchase_price', 11, 2)->default(0);
            //purchase price (trade price)
            $table->decimal('sale_price', 11, 2)->default(0);
            //regular sale price (mrp)
            
            $table->decimal('profit', 11, 2)->default(0);
            // (profit = sale_price - purchase_price)
            
            $table->decimal('pv', 11, 2)->default(0);
            // profit value (1pv = 1tk) {sales point} [manual entry]
            
            // $table->integer('tax')->default(0);
            // in percent

            $table->decimal('unit_weight', 9,2)->nullable();
             //20.5  in 
            // $table->string('unit')->nullable();
            //kg, meter, liter, 
            $table->bigInteger('addedby_id')->unsigned();
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
        Schema::dropIfExists('products');
    }
}
