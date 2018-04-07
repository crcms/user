<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_verification', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id')->default(0)->comment('User Id');
            $table->unsignedTinyInteger('type')->default(0)->comment('verify type');
            $table->unsignedBigInteger('created_at')->default(0)->comment('创建时间');
            $table->unsignedBigInteger('updated_at')->default(0)->comment('修改时间');
            $table->unsignedTinyInteger('status')->default(0)->comment('verify status , 1 ok ,2 no');
            $table->ipAddress('ip')->default('0.0.0.0')->comment('ip address');
            $table->string('ext',255)->default('')->comment('ext');
//            $table->string('url',1024)->default('')->comment('url');

            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_verification');
    }
}
