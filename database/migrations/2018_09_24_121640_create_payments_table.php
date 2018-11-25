<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('UserId');
            $table->unsignedInteger('to_user_id')->nullable()->comment('toUserId');
            $table->unsignedInteger('receivable_id')->nullable()->comment('应收表ID');
            $table->unsignedInteger('payable_id')->nullable()->comment('应付表ID');

            $table->string('customer')->nullable()->comment('客户名称');
            $table->string('goods_name')->nullable()->comment('品名');
            $table->string('packing')->nullable()->comment('包装');
            $table->string('number_id')->nullable()->comment('清单号');
            $table->string('extract_id')->nullable()->comment('提单号');
            $table->string('weight_box')->nullable()->comment('箱量净重(千克)');
            $table->string('quantity')->nullable()->comment('数量(吨)');
            $table->decimal('price_income_package')->nullable()->comment('协议(收入)包干费单价');
            $table->decimal('price_cost_package')->nullable()->comment('实际(成本)包干费单价');

            $table->decimal('fee_receivable')->nullable()->comment('应收合计');
            $table->decimal('fee_bale_receivable')->nullable()->comment('应收包干小计');
            $table->decimal('fee_before_receivable')->nullable()->comment('应收代垫费用小计');
            $table->decimal('fee_exchange_receivable')->nullable()->comment('换单费');
            $table->decimal('fee_harbor_receivable')->nullable()->comment('港杂费');
            $table->decimal('fee_customs_receivable')->nullable()->comment('代理报关费');
            $table->decimal('fee_inspection_agent_receivable')->nullable()->comment('报检代理费');
            $table->decimal('fee_inspection_goods_receivable')->nullable()->comment('商检验货代理费');
            $table->decimal('fee_inspection_receivable')->nullable()->comment('商检查验费');
            $table->decimal('fee_inspection_quarantine_receivable')->nullable()->comment('检验检疫费');
            $table->decimal('fee_dig_box_receivable')->nullable()->comment('掏箱费');
            $table->decimal('fee_transport_short_receivable')->nullable()->comment('短途运费');
            $table->decimal('fee_emergency_receivable')->nullable()->comment('紧急成本附加费-ECRS');
            $table->decimal('fee_storage_receivable')->nullable()->comment('堆存保管费');
            $table->decimal('fee_cleaning_box_receivable')->nullable()->comment('修洗箱费');
            $table->decimal('fee_adjusting_box_receivable')->nullable()->comment('调箱费');
            $table->decimal('fee_repair_box_receivable')->nullable()->comment('代理修箱费');

            $table->decimal('fee_payable')->nullable()->comment('应付合计');
            $table->decimal('fee_bale_payable')->nullable()->comment('应付包干小计');
            $table->decimal('fee_before_payable')->nullable()->comment('应付代垫费用小计');
            $table->decimal('fee_exchange_payable')->nullable()->comment('换单费');
            $table->decimal('fee_harbor_payable')->nullable()->comment('港杂费');
            $table->decimal('fee_customs_payable')->nullable()->comment('代理报关费');
            $table->decimal('fee_inspection_agent_payable')->nullable()->comment('报检代理费');
            $table->decimal('fee_inspection_goods_payable')->nullable()->comment('商检验货代理费');
            $table->decimal('fee_inspection_payable')->nullable()->comment('商检查验费');
            $table->decimal('fee_inspection_quarantine_payable')->nullable()->comment('检验检疫费');
            $table->decimal('fee_dig_box_payable')->nullable()->comment('掏箱费');
            $table->decimal('fee_transport_short_payable')->nullable()->comment('短途运费');
            $table->decimal('fee_emergency_payable')->nullable()->comment('紧急成本附加费-ECRS');
            $table->decimal('fee_storage_payable')->nullable()->comment('堆存保管费');
            $table->decimal('fee_cleaning_box_payable')->nullable()->comment('修洗箱费');
            $table->decimal('fee_adjusting_box_payable')->nullable()->comment('调箱费');
            $table->decimal('fee_repair_box_payable')->nullable()->comment('代理修箱费');

            $table->text('remark')->nullable()->comment('备注');

            $table->timestamp('times_at')->nullable()->comment('应收记录时间');
            $table->timestamp('times_end')->nullable()->comment('应付时间');
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
        Schema::dropIfExists('payments');
    }
}
