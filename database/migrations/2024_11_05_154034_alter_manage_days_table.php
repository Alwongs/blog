<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterManageDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manage_days', function (Blueprint $table) {
            $table->string('color_id')->nullable();
            $table->string('status')->default('A');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manage_days', function (Blueprint $table) {
            $table->dropColumn('color_id');
            $table->dropColumn('status');
        });
    }
}
