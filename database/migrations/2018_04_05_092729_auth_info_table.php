<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('created_at')->default(0)->comment('登录时间');
            $table->ipAddress('ip')->nullable()->comment('Ip Address');
            $table->unsignedTinyInteger('type')->default(0)->comment('类型，1:login,2:register');
            $table->string('agent',1024)->nullable()->comment('User Agent');
            $table->string('ext',255)->default('')->comment('附加信息');
            $table->unsignedInteger('user_id')->default(0)->comment('user id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_info');
    }
}
