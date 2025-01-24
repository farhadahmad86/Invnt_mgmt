<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobHoldReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_hold_reasons', function (Blueprint $table) {
            $table->bigIncrements('job_hold_reason_id');
            $table->string('job_hold_reason_name',500)->unique()->nullable();
            $table->string('job_hold_reason_remarks',500)->nullable();
            $table->integer('job_hold_reason_user_id')->nullable();
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
        Schema::dropIfExists('job_hold_reasons');
    }
}
