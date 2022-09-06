<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('activity_log');
        Schema::create('activity_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('reference_id')->nullable();
            $table->string('action')->nullable();
            $table->string('route')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('browser')->nullable();
            $table->string('platform')->nullable();
            $table->text('request')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('activity_log');
    }
}
