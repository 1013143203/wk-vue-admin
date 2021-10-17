<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('role_menu')) {
            Schema::create('role_menu', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('role_id')->unsigned()->index();
                $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
                $table->integer('menu_id')->unsigned()->index();
                $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
            });
            \DB::statement("ALTER TABLE `role_menu` comment'角色菜单表'"); // 表注释
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_route');
    }
}
