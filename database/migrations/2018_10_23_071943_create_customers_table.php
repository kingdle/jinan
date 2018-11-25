<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('UserId');
            $table->string('number_id')->nullable()->comment('编号');
            $table->string('customer')->nullable()->comment('客户名称');
            $table->string('trade')->nullable()->comment('所属行业');
            $table->string('goods')->nullable()->comment('主要货品');
            $table->string('address')->nullable()->comment('地址');
            $table->string('address_name')->nullable()->comment('详细地址');
            $table->string('longitude')->nullable()->comment('经度');
            $table->string('latitude')->nullable()->comment('纬度');
            $table->string('linkman')->nullable()->comment('联系人');
            $table->string('phone')->nullable()->comment('联系电话');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('web_url')->nullable()->comment('网址');
            $table->string('logo')->nullable()->comment('企业logo');
            $table->text('agreement_id')->nullable()->comment('协议号');
            $table->string('agreement_year')->default(0)->comment('当前协议年度');
            $table->text('agreement_url')->nullable()->comment('当前协议附件链接');
            $table->text('agreement_name')->nullable()->comment('当前协议附件原名称');
            $table->string('code')->nullable()->comment('客户小程序码');
            $table->unsignedInteger('write_user_id')->nullable()->comment('业务人员Id');
            $table->timestamp('write_at')->nullable()->comment('业务人员录入时间');
            $table->unsignedInteger('auditor_user_id')->nullable()->comment('审核人员Id');
            $table->timestamp('auditor_at')->nullable()->comment('审核时间');
            $table->integer('order_count')->default(0)->comment('订单数');
            $table->integer('comment_count')->default(0)->comment('评论数');
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
        Schema::dropIfExists('customers');
    }
}
