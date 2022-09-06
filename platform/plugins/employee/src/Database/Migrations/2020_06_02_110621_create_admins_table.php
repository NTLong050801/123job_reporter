<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('admins');
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('department_id');
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('skype')->unique();
            $table->integer('admin_id')->nullable();
            $table->tinyInteger('active')->index();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
