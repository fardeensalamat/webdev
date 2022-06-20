<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('drag_id')->unsigned()->nullable();
            $table->string('name')->nullable()->index();
            $table->string('description')->nullable();
            $table->string('img_name')->nullable();
            $table->string('banner_name')->nullable();
            $table->integer('work_station_id')->nullable();
            //title and description in localeable table

            // service profile sp
            $table->string('sp_title')->nullable();
            $table->string('sp_description')->nullable();
            $table->string('sp_header_bg_color')->nullable();
            $table->string('sp_header_text_color')->nullable();
            $table->string('sp_footer_bg_color')->nullable();
            $table->string('sp_footer_text_color')->nullable();
            $table->string('sp_body_bg_color')->nullable();
            $table->string('sp_body_text_color')->nullable();
            $table->decimal('sp_short_price',10,2)->default(0);
            $table->decimal('sp_full_price',10,2)->default(0);
            $table->integer('sp_full_price_owner_com')->default(0);
            $table->integer('sp_short_price_owner_com')->default(0);
            $table->boolean('sp_chat')->default(1);
            $table->boolean('sp_review')->default(1);
            $table->boolean('sp_active')->default(0);
            $table->boolean('sp_featured')->default(1);
            $table->boolean('sp_location')->default(1);
            $table->boolean('sp_bidding')->default(0);
            $table->float('sp_create_charge',10,2)->default(1);

            $table->string('pp_title')->nullable();
            $table->string('pp_description')->nullable();
            $table->string('pp_header_bg_color')->nullable();
            $table->string('pp_header_text_color')->nullable();
            $table->string('pp_footer_bg_color')->nullable();
            $table->string('pp_footer_text_color')->nullable();
            $table->string('pp_body_bg_color')->nullable();
            $table->string('pp_body_text_color')->nullable();
            $table->boolean('pp_chat')->default(1);
            $table->boolean('pp_review')->default(1);
            $table->boolean('pp_active')->default(0);
            $table->boolean('pp_featured')->default(1);
            $table->boolean('pp_location')->default(1);
            $table->string('sp_short_p_view_btn_txt')->nullable();
            $table->string('sp_full_p_view_btn_txt')->nullable();
            

            
            $table->boolean('active')->default(1);
            $table->boolean('featured')->default(0);
            
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
        Schema::dropIfExists('categories');
    }
}
