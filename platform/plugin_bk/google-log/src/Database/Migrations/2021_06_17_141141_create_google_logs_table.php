<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateGoogleLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('app_int')->default(0)->index();
            $table->string('app_text', 191)->nullable();
            $table->tinyInteger('log_int')->default(0)->index();
            $table->string('log_text', 191)->nullable();
            $table->float('hit')->default(0);
            $table->string('path', 191)->nullable();
            $table->string('label_page', 191)->nullable()->index();
            $table->date('source_created_at')->nullable()->index();

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
        Schema::dropIfExists('google_logs');
    }
}
