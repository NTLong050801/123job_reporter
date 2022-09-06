<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusInTableRobotVisits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('robot_visits', function (Blueprint $table) {
            $table->tinyInteger("report_status")->default(0)->after("ip_address");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('robot_visits', function (Blueprint $table) {
            $table->dropColumn("report_status");
        });

    }
}
