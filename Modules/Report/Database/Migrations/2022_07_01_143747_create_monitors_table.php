<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('url');
            $table->integer('site_id');
            $table->tinyInteger('uptime_check_enabled')->default(0);
            $table->tinyInteger('certificate_check_enabled')->default(0);
            $table->tinyInteger('uptime_check_interval_in_minutes')->nullable();
            $table->tinyInteger('uptime_check_payload')->nullable();
            $table->string('uptime_check_response_checker')->nullable();
            $table->string('look_for_string')->nullable();
            $table->tinyInteger('uptime_check_method');
            $table->json('additional_headers')->nullable();
            $table->integer('uptime_status')->nullable();
            $table->integer('uptime')->nullable();
            $table->json('payload_rule')->nullable();
            $table->tinyInteger('cert_status')->nullable();
            $table->dateTime('last_check')->nullable();
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
        Schema::dropIfExists('monitors');
    }
}
