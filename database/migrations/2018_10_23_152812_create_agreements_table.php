<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique()->nullable()->comment('UserId');
            $table->text('customer_id')->nullable()->comment('客户ID');
            $table->string('year')->default(0)->comment('协议年度');
            $table->string('item')->nullable()->comment('协议项目名称');
            $table->string('fee_category')->default('0')->comment('类别');
            $table->string('fee')->nullable()->comment('协议单价');
            $table->string('weight')->nullable()->comment('重量');
            $table->string('total_fee')->nullable()->comment('总价');

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
        Schema::dropIfExists('agreements');
    }
}
