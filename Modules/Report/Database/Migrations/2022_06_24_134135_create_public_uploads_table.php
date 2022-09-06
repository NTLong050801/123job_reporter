<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('site_id');
            $table->dateTime('time');
            $table->integer('count_get')->comment('chỉ số lấy')->index();
            $table->integer('count_create')->comment('chỉ số tạo mới')->index();
            $table->integer('count_update')->comment('chỉ số cập nhật')->index();
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
        Schema::dropIfExists('public_uploads');
    }
}
