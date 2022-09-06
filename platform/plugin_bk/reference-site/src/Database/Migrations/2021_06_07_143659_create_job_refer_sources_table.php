<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateJobReferSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_refer_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("source_id")->default(0)->index();
            $table->tinyInteger("app_int")->default(1);
            $table->string("app_text")->nullable();
            $table->string("site_name")->nullable();
            $table->integer("provider_id")->default(0);
            $table->text("meta_data")->nullable();
            $table->text("meta_data_transform")->nullable();
            $table->text("meta_agent")->nullable();
            $table->text("meta_agent_transform")->nullable();
            $table->integer("analyst_status")->default(0);
            $table->integer("report_status")->default(0);
            $table->text("report_meta")->nullable();
            $table->dateTime("source_created_at")->index();
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
        Schema::dropIfExists('job_refer_sources');
    }
}
