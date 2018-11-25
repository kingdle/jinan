<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSystemPartToAbroadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abroads', function (Blueprint $table) {
            $table->string('system_part')->nullable()->after('level')->comment('所属系统');
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
            $table->dropColumn('system_part');
        });
    }
}
