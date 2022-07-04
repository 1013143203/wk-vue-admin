<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->text('value')->nullable();
                $table->string('description')->nullable();
                $table->integer('status')->default(2)->comment('是否显示');
                $table->integer('create_id')->default(0);
                $table->integer('update_id')->default(0);
                $table->timestamps();
                $table->softDeletes();
            });
            \DB::statement("ALTER TABLE `settings` comment'配置表'"); // 表注释
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
