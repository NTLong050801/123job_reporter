<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_seos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('site_id')->index();
            $table->dateTime('time');
            $table->integer('address')->index();
            $table->integer('salary')->index();
            $table->integer('level')->index();
            $table->integer('category')->index();
            $table->integer('title')->index();
            $table->integer('company')->index();
            $table->integer('work_type')->index();
            $table->text('meta')->nullable();
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
        Schema::dropIfExists('report_seos');
    }
}
