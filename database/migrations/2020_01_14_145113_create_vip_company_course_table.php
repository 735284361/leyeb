<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVipCompanyCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_company_course', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('justice_id')->comment('系列课ID');
            $table->integer('admin_id')->comment('管理员用户编号');
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
        Schema::dropIfExists('vip_company_course');
    }
}
