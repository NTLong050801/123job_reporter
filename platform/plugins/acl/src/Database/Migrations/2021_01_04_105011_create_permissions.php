<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try
        {
            Schema::create('admin_permissions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('name');
                $table->tinyInteger('menu_id');
                $table->tinyInteger('is_sidebar')->default(0);
                $table->integer('parent_id')->default(0);
                $table->tinyInteger('has_child')->default(0);
                $table->string('icon')->default('fa fa-circle-o');
                $table->integer('sort')->default(0);
                $table->string('uri')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->tinyInteger('show_sidebar')->default(0);
                $table->tinyInteger('type')->default(0);
                $table->integer('admin_id')->default(1);
                $table->integer('number_user')->nullable()->default(1);
                $table->string('plugin')->nullable()->default(null);
                $table->timestamps();
            });

            Schema::create('admin_roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 191);
                $table->string('slug', 191)->unique();
                $table->integer('number_user')->default(0);
                $table->integer('number_permission')->default(0);
                $table->string('name', 191);
                $table->string('description')->nullable();
                $table->integer('company_id')->default(1);
                $table->integer('admin_id')->default(1)->unsigned();
                $table->timestamps();
            });

            Schema::create('admin_role_user', function (Blueprint $table) {
                $table->integer('admin_id');
                $table->integer('role_id');
                $table->unique(['admin_id', 'role_id'], 'unique_admin_role');
                $table->smallInteger('active')->default(1);
                $table->timestamps();
            });

            Schema::create('admin_permission_user', function (Blueprint $table) {
                $table->integer('admin_id');
                $table->integer('permission_id');
                $table->unique(['admin_id', 'permission_id'], 'unique_admin_permission');
                $table->smallInteger('active')->default(1);
                $table->timestamps();
            });

            Schema::create('admin_role_permission', function (Blueprint $table) {
                $table->integer('role_id');
                $table->integer('permission_id');
                $table->unique(['role_id', 'permission_id'], 'unique_role_permission');
                $table->smallInteger('active')->default(1);
                $table->timestamps();
            });
        }catch (\Exception $e)
        {

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_role_user');
        Schema::dropIfExists('admin_permission_user');
        Schema::dropIfExists('admin_role_permission');
    }
}
