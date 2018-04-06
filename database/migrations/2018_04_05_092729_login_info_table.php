<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoginInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('created_at')->default(0)->comment('登录时间');
            $table->ipAddress('ip')->nullable()->comment('Ip Address');
            $table->string('agent',1024)->nullable()->comment('User Agent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_info');
    }
}
