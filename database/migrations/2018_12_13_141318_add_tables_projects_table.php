<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTablesProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('item_subhead')->nullable()->after('item_name')->comment('已纳统项目名称');
            $table->timestamp('register_at')->nullable()->after('holding')->comment('企业注册日期');
            $table->text('industry_name')->nullable()->after('industry_code')->comment('纳统行业名称');
            $table->text('industry_type')->nullable()->after('industry_name')->comment('所属十强产业类别');
            $table->text('industry_description')->nullable()->after('industry_type')->comment('产业说明');
            $table->text('investor_name')->nullable()->after('item_type')->comment('投资方名称');
            $table->text('investor_address')->nullable()->after('investor_name')->comment('投资方地区');
            $table->text('is_industry')->nullable()->after('no_statistics')->comment('是否属于十强产业分类');
            $table->text('statistics_code')->nullable()->after('is_industry')->comment('纳统项目代码');
            $table->text('is_additional')->nullable()->after('fee')->comment('是否增资扩股收购兼并');
            $table->text('fee_public_plan')->nullable()->after('is_additional')->comment('省外国资计划');
            $table->text('fee_private_plan')->nullable()->after('fee_public_plan')->comment('省外民资计划');
            $table->text('fee_foreign_plan')->nullable()->after('fee_private_plan')->comment('外资计划');
            $table->text('fee_public_actual')->nullable()->after('fee_foreign_plan')->comment('省外国资实际');
            $table->text('fee_private_actual')->nullable()->after('fee_public_actual')->comment('省外民资实际');
            $table->text('fee_foreign_actual')->nullable()->after('fee_private_actual')->comment('外资实际');
            $table->text('bank_name')->nullable()->after('fee_foreign_actual')->comment('银行名称');
            $table->text('bank_bill')->nullable()->after('bank_name')->comment('银行进账单号');
            $table->text('bank_at')->nullable()->after('bank_bill')->comment('到账日期');
            $table->text('builder_licence')->nullable()->after('bank_at')->comment('施工许可证');
            $table->text('ratio_input_output')->nullable()->after('builder_licence')->comment('达产投入产出比');
            $table->text('files_id')->nullable()->after('files')->comment('验收报告文号');
            $table->text('linkman')->nullable()->after('phone')->comment('联系人');
            $table->text('job')->nullable()->after('linkman')->comment('职务');
            $table->text('status')->nullable()->after('job')->comment('状态0到位资金1开工2开业3竣工');
            $table->text('remarks')->nullable()->after('status')->comment('备注');
            $table->text('year_at')->nullable()->after('remarks')->comment('年度');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('item_subhead');
            $table->dropColumn('register_at');
            $table->dropColumn('industry_name');
            $table->dropColumn('industry_type');
            $table->dropColumn('industry_description');
            $table->dropColumn('investor_name');
            $table->dropColumn('investor_address');
            $table->dropColumn('is_industry');
            $table->dropColumn('statistics_code');
            $table->dropColumn('is_additional');
            $table->dropColumn('fee_public_plan');
            $table->dropColumn('fee_private_plan');
            $table->dropColumn('fee_foreign_plan');
            $table->dropColumn('fee_public_actual');
            $table->dropColumn('fee_private_actual');
            $table->dropColumn('fee_foreign_actual');
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_bill');
            $table->dropColumn('bank_at');
            $table->dropColumn('builder_licence');
            $table->dropColumn('ratio_input_output');
            $table->dropColumn('files_id');
            $table->dropColumn('linkman');
            $table->dropColumn('job');
            $table->dropColumn('status');
            $table->dropColumn('remarks');
            $table->dropColumn('year_at');
        });
    }
}
