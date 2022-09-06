<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateSubscribeJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_jobs', function (Blueprint $table) {
            $table->integer("source_id")->default(0);
            $table->integer("app_int");
            $table->integer("attr_int");
            $table->string("attr_text");
            $table->string("attr_text_slug")->unique();
            $table->integer("hint");
            $table->date("source_created_at");
            $table->index(['attr_int', 'attr_text_slug', 'source_created_at']);
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
        Schema::dropIfExists('subscribe_jobs');
    }
}
