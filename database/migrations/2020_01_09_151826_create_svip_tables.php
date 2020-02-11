<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSvipTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company')->comment('公司名称');
            $table->string('contact_name')->nullable()->comment('联系人');
            $table->string('contact_phone')->nullable()->comment('联系电话');
            $table->string('contact_email')->nullable()->comment('联系邮箱');
            $table->string('city')->nullable()->comment('城市');
            $table->integer('admin_id')->comment('关联的管理员编号');
            $table->timestamp('end_at')->nullable()->comment('会员到期时间');
            $table->integer('member_count')->comment('允许的学员数量');
            $table->timestamps();
        });

        Schema::create('vip_company_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->comment('公司编号');
            $table->integer('uid')->comment('用户编号');
            $table->string('name')->nullable()->comment('用户姓名');
            $table->tinyInteger('status')->default(0)->comment('状态');
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
        Schema::dropIfExists('vip_company');
    }
}
