<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('province')->nullable()->comment('省');
            $table->string('city')->nullable()->comment('市');
            $table->string('district')->nullable()->comment('区');
            $table->string('street')->nullable()->comment('街镇');
            $table->string('village')->nullable()->comment('村');
            $table->string('address')->nullable()->comment('管区所在地');
            $table->string('latitude')->nullable()->comment('管区所在纬度');
            $table->string('longitude')->nullable()->comment('管区所在经度');
            $table->string('items_num')->nullable()->comment('项目个数');
            $table->decimal('fee')->nullable()->comment('到位资金');
            $table->string('start_num')->nullable()->comment('开工项目');
            $table->string('end_num')->nullable()->comment('竣工项目');
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
        Schema::dropIfExists('areas');
    }
}
