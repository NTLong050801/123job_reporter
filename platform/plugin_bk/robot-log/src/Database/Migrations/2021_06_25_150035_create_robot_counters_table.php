<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRobotCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robot_counters', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('app_int')->index();
            $table->string('app_text', 191);
            $table->string('bot', 191)->index();
            $table->integer('total_visit')->default(0);
            $table->integer('total_time')->default(0);
            $table->date('date')->index();
            $table->string('path', 191)->nullable();
            $table->string('label_page', 191)->nullable()->index();
            $table->integer('min_execute_time')->default(0);
            $table->integer('max_execute_time')->default(0);
            $table->integer('avg_execute_time')->default(0);
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
        Schema::dropIfExists('robot_counters');
    }
}
