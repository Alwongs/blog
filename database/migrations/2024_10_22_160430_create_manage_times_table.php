<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manage_day_id')->constrained()->onDelete('cascade');
            $table->string('title', 255);
            $table->string('time_from', 20);
            $table->string('time_to', 20);
            $table->char('status', 1)->default('A');
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
        Schema::dropIfExists('manage_times');
    }
}
