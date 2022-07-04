<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_action_log')) {
            Schema::create('user_action_log', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 20)->nullable();
                $table->integer('user_id')->unsigned();
                $table->string('user_name', 20)->nullable();
                $table->string('ip', 20)->nullable();
                $table->string('action', 100)->nullable()->comment('方法');
                $table->string('method', 20)->nullable()->comment('请求方式');
                $table->string('url')->nullable()->comment('url');
                $table->string('timing', 50)->comment('响应时长(秒)');
                $table->text('params')->comment('参数')->nullable();
                $table->string('user_agent')->nullable()->comment('user_agent');
                $table->timestamps();
            });
            \DB::statement("ALTER TABLE `user_action_log` comment'操作记录表'"); // 表注释
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_action_log');
    }
}
