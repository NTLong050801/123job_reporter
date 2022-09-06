<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('phone')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('link')->nullable()->index();
            $table->string('avatar')->nullable();
            $table->string('position')->nullable();
            $table->string('sub_position')->nullable();
            $table->string('care')->nullable();
            $table->unsignedInteger('location_id')->default(0)->index();
            $table->string('location_text')->nullable();
            $table->string('address')->nullable();
            $table->string('address_work')->nullable();
            $table->unsignedInteger('career_int')->default(0)->index();
            $table->string('career_text')->nullable();
            $table->unsignedInteger('rank_int')->default(0)->index();
            $table->string('rank_text')->nullable();
            $table->unsignedInteger('gender_int')->default(0);
            $table->string('gender_text')->nullable();
            $table->unsignedInteger('work_type_int')->default(0);
            $table->string('work_type_text')->nullable();
            $table->unsignedInteger('exp_int')->default(0);
            $table->string('exp_text')->nullable();
            $table->unsignedInteger('degree_int')->default(0)->index();
            $table->string('degree_text')->nullable();
            $table->string('birth_date')->nullable();
            $table->unsignedInteger('age_int')->default(0);
            $table->string('age_text')->nullable();
            $table->unsignedInteger('salary_int')->default(0);
            $table->string('salary_text')->nullable();
            $table->longText('company')->nullable();
            $table->longText('school')->nullable();
            $table->text('skill')->nullable();
            $table->text('intro')->nullable();
            $table->longText('content')->nullable();
            $table->string('cv_path')->nullable();
            $table->tinyInteger('cv_type')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('source_int')->default(0);
            $table->string('source_text')->nullable();
            $table->text('meta_info')->nullable();
            $table->text('meta_analyst')->nullable();
            $table->unsignedInteger('timestamp')->nullable();
            $table->timestamp('added_at')->nullable();
            $table->timestamps();
        });

        Schema::create('cv_reports', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('total')->default(0);
            $table->tinyInteger('quarter')->default(0);
            $table->string('date')->nullable();
            $table->unsignedInteger('timestamp')->default(0);
            $table->tinyInteger('source_int')->default(0);
            $table->string('source_text')->nullable();
            $table->timestamps();
        });

        Schema::create('career_reports', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('career_id')->default(0)->index();
            $table->string('career_text')->nullable();
            $table->unsignedInteger('total')->default(0);
            $table->date('date')->nullable();
            $table->unsignedInteger('timestamp')->default(0);
            $table->tinyInteger('source_int')->default(0);
            $table->string('source_text')->nullable();
            $table->timestamps();
        });

        Schema::create('rank_reports', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('rank_id')->default(0)->index();
            $table->string('rank_text')->nullable();
            $table->unsignedInteger('total')->default(0);
            $table->date('date')->nullable();
            $table->unsignedInteger('timestamp')->default(0);
            $table->tinyInteger('source_int')->default(0);
            $table->string('source_text')->nullable();
            $table->timestamps();
        });

        Schema::create('degree_reports', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('degree_id')->default(0)->index();
            $table->string('degree_text')->nullable();
            $table->unsignedInteger('total')->default(0);
            $table->date('date')->nullable();
            $table->unsignedInteger('timestamp')->default(0);
            $table->tinyInteger('source_int')->default(0);
            $table->string('source_text')->nullable();
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
        Schema::dropIfExists('candidates');
        Schema::dropIfExists('cv_reports');
        Schema::dropIfExists('career_reports');
        Schema::dropIfExists('rank_reports');
        Schema::dropIfExists('degree_reports');
    }
}
