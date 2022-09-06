<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRobotVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robot_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('app_int')->default(0)->index();
            $table->string('app_text', 191)->nullable();
            $table->string('bot', 191)->nullable()->index();
            $table->integer('execute_time')->default(0);
            $table->string('url_visit', 255)->nullable();
            $table->string('path', 191)->nullable();
            $table->string('label_page', 191)->nullable();
            $table->dateTime('visited_at')->nullable()->index();
            $table->string('ip_address', 191)->nullable();
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
        Schema::dropIfExists('robot_visits');
    }
}
