<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVipCompanyTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_company_token', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id');
            $table->integer('uid')->nullable();
            $table->tinyInteger('status')->default(0)->comment('使用状态 0-未使用；1-已使用');
            $table->string('token')->comment('邀请码');
            $table->timestamp('expire_at')->nullable()->comment('过期时间');
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
        Schema::dropIfExists('vip_company_token');
    }
}
