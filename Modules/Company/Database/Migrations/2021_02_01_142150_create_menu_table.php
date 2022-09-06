<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('menus'))
        {
            Schema::create('menus', function (Blueprint $table) {
                $table->increments('id');
                $table->string('menu_name')->nullable();
                $table->string('menu_slug')->nullable()->unique();
                $table->integer('menu_sort')->default(0);
                $table->string('menu_status')->default(0);
                $table->string('menu_icon')->nullable();
                $table->integer('menu_menu_hit')->default(0);
                $table->integer('menu_type')->default(0);
                $table->string('menu_link')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
