<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('member_level')) {
            Schema::create('member_level', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->integer('level')->unique();
                $table->integer('status')->default(1)->nullable();
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
        Schema::dropIfExists('member_level');
    }
}
