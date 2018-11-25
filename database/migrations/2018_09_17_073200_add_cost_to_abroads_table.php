<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCostToAbroadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abroads', function (Blueprint $table) {
            $table->string('by_group')->nullable()->after('linkman_phone')->comment('自组随团');
            $table->string('visits_category')->nullable()->after('by_group')->comment('出访类别');
            $table->string('days')->nullable()->after('place_to')->comment('停留时间');
            $table->string('batch_number')->nullable()->after('days')->comment('批件号');
            $table->decimal('funds')->nullable()->after('batch_number')->comment('经费');
            $table->string('remarks')->nullable()->after('funds')->comment('备注');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abroads', function (Blueprint $table) {
            $table->dropColumn('by_group');
            $table->dropColumn('visits_category');
            $table->dropColumn('days');
            $table->dropColumn('batch_number');
            $table->dropColumn('funds');
            $table->dropColumn('remarks');
        });
    }
}
