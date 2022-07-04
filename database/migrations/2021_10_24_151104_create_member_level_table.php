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
                $table->integer('status')->default(2);
                $table->integer('create_id')->default(0);
                $table->integer('update_id')->default(0);
                $table->softDeletes();
                $table->timestamps();
            });
        }
        \DB::statement("ALTER TABLE `member_level` comment'用户等级'"); // 表注释
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
