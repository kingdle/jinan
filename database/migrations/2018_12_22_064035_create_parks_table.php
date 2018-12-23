<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('园区名');
            $table->text('pic')->nullable()->comment('园区图片');
            $table->string('acreage_plan')->nullable()->comment('规划面积');
            $table->string('acreage_open')->nullable()->comment('开发面积');
            $table->string('acreage_industry')->nullable()->comment('工业用地面积');
            $table->string('sum_development_research')->nullable()->comment('研发机构数');
            $table->string('sum_development_innovate')->nullable()->comment('创新服务机构数');
            $table->string('sum_development_finance')->nullable()->comment('金融服务机构数');
            $table->string('sum_item_foreign_plan')->nullable()->comment('新批准外商直接投资项目个数');
            $table->decimal('sum_item_foreign_actual')->nullable()->comment('实际到位外商直接投资金额');
            $table->string('sum_item_outside_city_plan')->nullable()->comment('实际市外境内合作项目个数');
            $table->decimal('fee_outside_city_actual')->nullable()->comment('实际到位市外境内资金');
            $table->decimal('fee_export')->nullable()->comment('出口总额');
            $table->string('sum_enterprise_four')->nullable()->comment('四上企业个数');
            $table->string('sum_enterprise_new')->nullable()->comment('高新企业个数');
            $table->string('sum_enterprise_in_exports')->nullable()->comment('进出口企业个数');
            $table->string('sum_industry')->nullable()->comment('规上工业企业个数');
            $table->string('sum_build')->nullable()->comment('资质建筑企业个数');
            $table->string('sum_mix')->nullable()->comment('限上批零住餐企业个数');
            $table->string('sum_service')->nullable()->comment('规上服务业企业个数');
            $table->string('sum_house')->nullable()->comment('房地产企业个数');
            $table->decimal('fee_profit')->nullable()->comment('利润总额');
            $table->decimal('fee_tax')->nullable()->comment('上交税金总额');
            $table->decimal('fee_enterprise_four')->nullable()->comment('四上营业收入');
            $table->decimal('fee_enterprise_new')->nullable()->comment('高新技术产业收入');
            $table->decimal('fee_enterprise_in_exports')->nullable()->comment('进出口企业个数');
            $table->decimal('fee_industry')->nullable()->comment('规上工业企业主营业务收入');
            $table->decimal('fee_build')->nullable()->comment('资质建筑业企业主营业务收入');
            $table->decimal('fee_mix')->nullable()->comment('限上批零住餐企业主营业务收入');
            $table->decimal('fee_service')->nullable()->comment('规上服务业企业营业收入');
            $table->decimal('fee_house')->nullable()->comment('完成固定资产投资额');
            $table->string('address')->nullable()->comment('管区所在地');
            $table->string('is_hidden')->default('F')->comment('是否隐藏');
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
        Schema::dropIfExists('parks');
    }
}
