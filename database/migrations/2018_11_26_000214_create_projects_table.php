<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('录入人');
            $table->string('name')->nullable()->comment('单位名');
            $table->string('id_code')->nullable()->comment('组织机构代码');
            $table->string('id_license')->nullable()->comment('营业执照号');
            $table->string('item_code')->nullable()->comment('项目代码');
            $table->string('item_name')->nullable()->comment('项目名称');
            $table->string('register_type')->nullable()->comment('注册类型');
            $table->string('province')->nullable()->comment('省');
            $table->string('city')->nullable()->comment('市');
            $table->string('district')->nullable()->comment('区');
            $table->string('street')->nullable()->comment('街镇');
            $table->string('village')->nullable()->comment('村');
            $table->string('address')->nullable()->comment('所在地');
            $table->string('district_code')->nullable()->comment('行政区划代码');
            $table->string('latitude')->nullable()->comment('管区所在纬度');
            $table->string('longitude')->nullable()->comment('管区所在经度');
            $table->string('phone')->nullable()->comment('联系电话');
            $table->string('industry_code')->nullable()->comment('行业编码');
            $table->string('holding')->nullable()->comment('控股情况1国有2集体3私人4港澳台商5外商9其他');
            $table->string('subjection')->nullable()->comment('隶属关系10中央20省40市80县及以下90其他');
            $table->string('item_nature')->nullable()->comment('建设性质1新建2扩建3改建和技术改造4单纯建造生活设施5迁建6恢复7单纯购置');
            $table->string('item_type')->nullable()->comment('项目类别1工业企业技术改造2棚户区改造3涉农');
            $table->timestamp('start_at')->nullable()->comment('项目开工时间');
            $table->timestamp('end_at')->nullable()->comment('项目竣工时间');
            $table->timestamp('produce_at')->nullable()->comment('投产时间');
            $table->string('item_state')->nullable()->comment('项目建设状态1在建2全部投产3全部停缓建');
            $table->text('images')->nullable()->comment('图片');
            $table->text('files')->nullable()->comment('附件');
            $table->string('fee_id')->nullable()->comment('项目投资情况ID');
            $table->smallInteger('is_hidden')->default(0)->comment('是否隐藏0否1是');
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
        Schema::dropIfExists('projects');
    }
}
