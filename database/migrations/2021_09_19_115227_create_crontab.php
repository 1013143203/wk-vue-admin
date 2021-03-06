<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrontab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('crontab')) {
            Schema::create('crontab', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->integer('sType')->default(1)->comment('1访问url 2shell脚本');
                $table->text('sBody')->nullable()->comment('脚本内容');
                $table->integer('tType')->nullable()->default(1)->comment('执行时间类型 day-n|n天 hour-n|n小时 minute-n|n分钟 -seconds|n秒 week|每周 month|每月');
                $table->integer('week')->default(0);
                $table->integer('day')->default(0);
                $table->integer('hour')->default(0);
                $table->integer('minute')->default(0);
                $table->integer('status')->default(2)->comment('是否显示');
                $table->integer('create_id')->default(0);
                $table->integer('update_id')->default(0);
                $table->softDeletes();
                $table->timestamps();
            });
        }
        \DB::statement("ALTER TABLE `crontab` comment'计划任务'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crontab');
    }
}
