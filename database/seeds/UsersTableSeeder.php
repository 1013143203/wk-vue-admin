<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'weikeai',
            'password' => Hash::make('1013143203..'),
        ]);
        // 角色
        \DB::table('role')->insert([
            'name' => '超级管理员',
            'status' => 1,
        ]);

        // 用户对应的角色
        \DB::table('user_role')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        dump('管理员添加 success');
    }
}
