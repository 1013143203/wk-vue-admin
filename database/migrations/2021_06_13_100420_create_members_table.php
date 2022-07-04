<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('member')) {
            Schema::create('member', function (Blueprint $table) {
                $table->increments('id');
                $table->string('avatar')->nullable();
                $table->integer('agentid')->default(0);
                $table->integer('level')->default(0);
                $table->string('nickname')->nullable();
                $table->string('realname')->nullable();
                $table->string('mobile',20);
                $table->string('password')->nullable();
                $table->decimal('credit1', 10, 2)->nullable()->comment('积分');
                $table->decimal('credit2', 10, 2)->nullable()->comment('余额');
                $table->integer('sex')->nullable()->comment('1男2女');

                $table->integer('pid')->comment('省')->nullable();
                $table->integer('cid')->comment('市')->nullable();
                $table->integer('aid')->comment('区(县)')->nullable();
                $table->integer('sid')->comment('街道(镇)')->nullable();
                $table->text('address_info')->nullable()->comment('具体地址');


                $table->integer('status')->default(2);
                $table->softDeletes();
                $table->string('description')->nullable();
                $table->integer('create_id')->default(0);
                $table->integer('update_id')->default(0);

                $table->timestamps();
            });
            \DB::statement("ALTER TABLE `member` comment'用户表'"); // 表注释
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}
