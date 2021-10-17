<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('menu')) {
            Schema::create('menu', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 20)->nullable();
                $table->integer('pid')->default(0);
                $table->string('icon')->nullable();
                $table->string('param')->nullable();
                $table->string('path')->nullable();
                $table->string('component')->nullable();
                $table->string('redirect')->nullable();
                $table->integer('type')->default(1)->comment('1是模块 2是菜单 3是节点');
                $table->string('permission')->nullable()->comment('权限标识');
                $table->integer('status')->default(1)->comment('是否显示');
                $table->integer('is_public')->default(2)->comment('1公共菜单');
                $table->string('description')->nullable();
                $table->timestamps();
            });
            \DB::statement("ALTER TABLE `menu` comment'菜单表'"); // 表注释
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route');
    }
}
