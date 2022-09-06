<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminLoginHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('admin_login_history');
        
        Schema::create('admin_login_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('admin_id')->index();
            $table->string('device')->nullable();
            $table->string('platform')->nullable();
            $table->string('platform_version')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('ip')->nullable();
            $table->string('city')->nullable();
            $table->string('region_code')->nullable();
            $table->string('region_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country_name')->nullable();
            $table->string('continent_code')->nullable();
            $table->string('continent_name')->comment('lục địa')->nullable();
            $table->string('latitude')->comment('vĩ độ')->nullable();
            $table->string('longitude')->comment('kinh độ')->nullable();
            $table->string('zipcode')->nullable();
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
        //
    }
}
