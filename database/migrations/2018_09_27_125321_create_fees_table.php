<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('UserId');
            $table->string('fee_category')->default('0')->comment('类别');
            $table->string('fee_name')->nullable()->comment('费用名称');
            $table->string('fee_scale')->nullable()->comment('收费标准');
            $table->string('fee_remark')->nullable()->comment('备注');
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
        Schema::dropIfExists('fees');
    }
}
