<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('file_systems')) {
            Schema::create('file_systems', function (Blueprint $table) {
                $table->increments('file_id')->comment('文件id');
                $table->integer('create_id')->default(0)->comment('创建id');
                $table->string('url')->comment('文件地址');
                $table->string('fileType')->nullable()->comment('文件类型');
                $table->string('type')->nullable()->comment('类型');
                $table ->string('name')->nullable()->comment('文件名');
                $table ->string('ext')->nullable()->comment('文件扩展名');
                $table->string('md5')->nullable()->unique()->comment('文件md5');
                $table->integer('size')->default(0)->comment('文件大小');
                $table->string('storage')->default('local')->comment('存储方式');
                $table->softDeletes();
                $table->timestamps();
            });
        }
        \DB::statement("ALTER TABLE `file_systems` comment'文件管理'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_systems');
    }
}
