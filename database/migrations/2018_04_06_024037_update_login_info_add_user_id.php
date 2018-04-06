<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLoginInfoAddUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('login_info', function (Blueprint $table) {
            //
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
        Schema::table('login_info', function (Blueprint $table) {
            //
            $table->dropIndex(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
