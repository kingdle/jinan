<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('UserId');
            $table->string('gift_id')->nullable()->comment('礼品ID');
            $table->string('hotel_id')->nullable()->comment('酒店ID');
            $table->string('number_id')->nullable()->comment('编号');
            $table->string('nation')->nullable()->comment('国别');
            $table->string('activity')->nullable()->comment('活动');
            $table->string('organizer')->nullable()->comment('主办单位');
            $table->string('delegation')->nullable()->comment('代表团名称');
            $table->string('office_works')->nullable()->comment('外办工作内容');
            $table->string('objective')->nullable()->comment('来访目的');
            $table->timestamp('times_at')->nullable()->comment('来访时间');
            $table->timestamp('times_end')->nullable()->comment('访问结束时间');
            $table->string('property')->nullable()->comment('性质');
            $table->string('gift')->nullable()->comment('礼品');
            $table->string('number_peoples')->nullable()->comment('人数');
            $table->text('banquet')->nullable()->comment('宴请');
            $table->text('banquet_hotel')->nullable()->comment('宴请酒店');
            $table->text('banquet_address')->nullable()->comment('宴请地址');
            $table->text('harvest')->nullable()->comment('来访成果');
            $table->text('assign')->nullable()->comment('交办');
            $table->text('reception_department')->nullable()->comment('接待科室');
            $table->text('reasons_plan')->nullable()->comment('接待方案');
            $table->text('reasons_content')->nullable()->comment('接待内容');
            $table->text('reasons_keynote')->nullable()->comment('接待重点');
            $table->text('enclosure')->nullable()->comment('附件');
            $table->string('suggestion_management_leader')->nullable()->comment('分管业务区领导意见');
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
        Schema::dropIfExists('receptions');
    }
}
