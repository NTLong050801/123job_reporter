<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateClientEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_events', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('app_int')->default(0)->index();
            $table->string('app_text', 191)->nullable();
            $table->tinyInteger('event_int')->default(0)->index();
            $table->string('event_text', 191)->nullable();
            $table->string('provider', 191)->nullable();
            $table->integer('hit')->default(0);
            $table->date('source_created_at')->nullable()->index();
            $table->string('path', 191)->nullable();
            $table->string('label_page', 191)->nullable()->index();
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
        Schema::dropIfExists('client_events');
    }
}
