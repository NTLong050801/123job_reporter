<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use phpDocumentor\Reflection\Types\Nullable;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('date_of_birth');
            $table->integer('company_id');
            $table->integer('department_id');
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
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
