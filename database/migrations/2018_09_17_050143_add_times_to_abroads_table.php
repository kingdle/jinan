<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimesToAbroadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abroads', function (Blueprint $table) {
            $table->timestamp('times_foreign_affairs')->nullable()->after('suggestion_foreign_affairs')->comment('工委外事工作领导小组办公室审批时间');
            $table->timestamp('times_inspection')->nullable()->after('suggestion_inspection')->comment('区纪律检查委员会审批时间');
            $table->timestamp('times_management_leader')->nullable()->after('suggestion_management_leader')->comment('分管业务区领导审批时间');
            $table->timestamp('times_foreign_affairs_leader')->nullable()->after('suggestion_foreign_affairs_leader')->comment('分管外事区领导审批时间');
            $table->timestamp('times_manage_committee')->nullable()->after('suggestion_manage_committee')->comment('管委主要领导审批时间');
            $table->timestamp('times_work_committee')->nullable()->after('suggestion_work_committee')->comment('工委主要领导审批时间');
            $table->text('pic')->nullable()->after('times_work_committee')->comment('审批附件');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abroads', function (Blueprint $table) {
            $table->dropColumn('times_foreign_affairs');
            $table->dropColumn('times_inspection');
            $table->dropColumn('times_management_leader');
            $table->dropColumn('times_foreign_affairs_leader');
            $table->dropColumn('times_manage_committee');
            $table->dropColumn('times_work_committee');
            $table->dropColumn('pic');
        });
    }
}
