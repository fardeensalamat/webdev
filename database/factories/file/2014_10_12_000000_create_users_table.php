<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index();
            $table->string('username', 32)
                    ->index()->nullable();
            $table->string('email', 32)
                  ->nullable()
                  ->index();
            $table->string('mobile', 32)
                  ->nullable()
                  ->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->string('password_temp')->nullable();
            $table->char('gender', 10)->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile_country', 2)
                  ->nullable();
            $table->string('calling_code', 5)
                  ->nullable();
            $table->string('currency_code', 3)
                  ->nullable();
            $table->decimal('balance', 10,2)->default(0);
            $table->string('img_name')->nullable();
            $table->boolean('active')->default(1);

            
            $table->timestamp('loggedin_at')->nullable();
            $table->string('sc_fb_group_link')->nullable();

            $table->string('sc_youtube_channel_link')->nullable();

            $table->string('sc_fb_group_link_image')->nullable();

            $table->string('sc_youtube_channel_link_image')->nullable();
            
            $table->rememberToken();
            // $table->foreignId('current_team_id')->nullable();
            // $table->text('profile_photo_path')->nullable();
            $table->integer('user_status')->default(1); 
            //1=user,2=smartshop //3=institution
            $table->bigInteger('addedby_id') //own id or other id
                  ->unsigned()
                  ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
