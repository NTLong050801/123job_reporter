<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateSubscribeJobSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribe_job_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('source_id');
            $table->integer('app_int')->nullable();
            $table->string('app_text')->nullable();
            $table->text("usk_meta_loc")->nullable();
            $table->text("usk_keyword")->nullable();
            $table->string("usk_city")->nullable();
            $table->string("usk_district")->nullable();
            $table->string("usk_salary")->nullable();
            $table->string("usk_text_full")->nullable();
            $table->string("usk_slug_unique")->nullable();
            $table->string("usk_email")->nullable();
            $table->string("usk_phone")->nullable();
            $table->string("usk_source")->comment("Nguồn từ subscribe");
            $table->text("usk_agent")->nullable();
            $table->text("usk_agent_transform")->nullable();
            $table->string("usk_ip_address")->nullable();
            $table->string("usk_device")->nullable();
            $table->integer("analyst_status")->default(0);
            $table->integer("report_status")->default(0);
            $table->text("report_meta")->nullable();
            $table->date("source_created_at")->index();
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
        Schema::dropIfExists('subscribe_job_sources');
    }
}
