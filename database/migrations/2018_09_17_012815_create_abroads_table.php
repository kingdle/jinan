<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbroadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abroads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('UserId');
            $table->string('gift_id')->nullable()->comment('礼品ID');
            $table->string('number_id')->nullable()->comment('编号');
            $table->string('department')->nullable()->comment('申报单位');
            $table->string('name')->nullable()->comment('姓名');
            $table->string('gender')->nullable()->comment('性别');
            $table->string('age')->nullable()->comment('年龄');
            $table->string('duties')->nullable()->comment('职务');
            $table->string('place_to')->nullable()->comment('出访地');
            $table->timestamp('times_at')->nullable()->comment('出访时间');
            $table->timestamp('times_end')->nullable()->comment('出访结束时间');
            $table->string('linkman')->nullable()->comment('联系人');
            $table->string('linkman_duties')->nullable()->comment('联系人职务');
            $table->string('linkman_phone')->nullable()->comment('联系人电话');
            $table->text('reasons_visit')->nullable()->comment('出访事由');
            $table->string('suggestion_foreign_affairs')->nullable()->comment('工委外事工作领导小组办公室意见');
            $table->string('suggestion_inspection')->nullable()->comment('区纪律检查委员会意见');
            $table->string('suggestion_management_leader')->nullable()->comment('分管业务区领导意见');
            $table->string('suggestion_foreign_affairs_leader')->nullable()->comment('分管外事区领导意见');
            $table->string('suggestion_manage_committee')->nullable()->comment('管委主要领导意见');
            $table->string('suggestion_work_committee')->nullable()->comment('工委主要领导意见');

            $table->string('close_comment')->default('F')->comment('关闭评论');
            $table->string('is_hidden')->default('F')->comment('隐藏');
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
        Schema::dropIfExists('abroads');
    }
}
