<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->index();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->integer('parent_id')->defaut(0);
            $table->integer('member_active')->default(0); // nhan su hoat dong
            $table->integer('member_inactive')->default(0); // Nhan su khong hoat dong
            $table->integer('status')->default(1); // trang thai
            $table->string('code', 50)->nullable();
            $table->string('admin_id')->default(1);  // nguoi tao
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
        Schema::dropIfExists('departments');
    }
}
