<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->index();
            $table->integer('admin_id')->default(1);
            $table->integer('type')->default(0);
            $table->string('name')->nullable();
            $table->string('hash_tag')->nullable();
            $table->integer('status')->default(0);
            $table->integer('must_read')->default(0);
            $table->string('files')->default(0);
            $table->integer('views')->default(0);
            $table->text('content')->nullable();
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
        Schema::dropIfExists('announcements');
    }
}
