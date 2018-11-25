<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentFeeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_fee_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('UserId');
            $table->unsignedInteger('payment_id')->nullable()->comment('货代表ID');
            $table->string('fee_id')->nullable()->comment('费用ID');
            $table->string('fee_name')->nullable()->comment('费用名称');
            $table->decimal('fee_sum')->nullable()->comment('金额');
            $table->string('fee_scale')->nullable()->comment('收费标准');
            $table->string('fee_category')->nullable()->comment('收费类别0收入1支出');
            $table->string('is_hidden')->default('F')->comment('是否结清');
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
        Schema::dropIfExists('payment_fee_items');
    }
}
