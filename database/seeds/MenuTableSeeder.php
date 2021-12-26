<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Menu;
class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            [
                'name'=>'权限管理',
                'icon'=>'lock',
                'path'=>'/auth',
                'component'=>'#',
                'redirect'=>'/auth/menu',
                'type'=>1,
                'status'=>1,
                'permission'=>'permission',
                "children"=>[
                    [
                        'name'=>'管理员管理',
                        'icon'=>'',
                        'path'=>'user',
                        'permission'=>'user',
                        'component'=>'user/index',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                            [
                                'name'=>'添加',
                                'icon'=>'',
                                'permission'=>'user:create',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'查看',
                                'icon'=>'',
                                'permission'=>'user:edit',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'保存',
                                'icon'=>'',
                                'permission'=>'user:update',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'删除',
                                'icon'=>'',
                                'permission'=>'user:delete',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'批量删除',
                                'icon'=>'',
                                'permission'=>'user:delAll',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'状态',
                                'icon'=>'',
                                'permission'=>'user:status',
                                'type'=>3,
                                'status'=>1,
                            ],
                        ]
                    ],
                    [
                        'name'=>'角色管理',
                        'icon'=>'',
                        'path'=>'role',
                        'permission'=>'role',
                        'component'=>'role/index',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                            [
                                'name'=>'添加',
                                'icon'=>'',
                                'permission'=>'role:create',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'查看',
                                'icon'=>'',
                                'permission'=>'role:edit',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'保存',
                                'icon'=>'',
                                'permission'=>'role:update',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'删除',
                                'icon'=>'',
                                'permission'=>'role:delete',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'批量删除',
                                'icon'=>'',
                                'permission'=>'role:delAll',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'状态',
                                'icon'=>'',
                                'permission'=>'role:status',
                                'type'=>3,
                                'status'=>1,
                            ],
                        ]
                    ],
                    [
                        'name'=>'菜单管理',
                        'icon'=>'',
                        'path'=>'menu',
                        'permission'=>'menu',
                        'component'=>'menu/index',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                            [
                                'name'=>'添加',
                                'icon'=>'',
                                'permission'=>'menu:create',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'查看',
                                'icon'=>'',
                                'permission'=>'menu:edit',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'保存',
                                'icon'=>'',
                                'permission'=>'menu:update',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'删除',
                                'icon'=>'',
                                'permission'=>'menu:delete',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'批量删除',
                                'icon'=>'',
                                'permission'=>'menu:delAll',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'状态',
                                'icon'=>'',
                                'permission'=>'menu:status',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'全部展开',
                                'icon'=>'',
                                'permission'=>'menu:expandAll',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'全部折叠',
                                'icon'=>'',
                                'permission'=>'menu:foldAll',
                                'type'=>3,
                                'status'=>1,
                            ],
                        ]
                    ],
                    [
                        'name'=>'日志管理',
                        'icon'=>'',
                        'path'=>'actionlog',
                        'permission'=>'actionlog',
                        'component'=>'actionlog/index',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                        ]
                    ],
                ],
            ],
            [
                'name'=>'用户管理',
                'icon'=>'user',
                'path'=>'/member',
                'permission'=>'',
                'redirect'=>'/member/index',
                'component'=>'#',
                'type'=>1,
                'status'=>1,
                "children"=>[
                    [
                        'name'=>'用户列表',
                        'icon'=>'',
                        'path'=>'index',
                        'permission'=>'member',
                        'component'=>'member/index',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                            [
                                'name'=>'添加',
                                'icon'=>'',
                                'permission'=>'member:create',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'查看',
                                'icon'=>'',
                                'permission'=>'member:edit',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'保存',
                                'icon'=>'',
                                'permission'=>'member:update',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'状态',
                                'icon'=>'',
                                'permission'=>'member:status',
                                'type'=>3,
                                'status'=>1,
                            ],
                        ]
                    ],
                    [
                        'name'=>'用户等级',
                        'icon'=>'',
                        'path'=>'level',
                        'permission'=>'memberLevel',
                        'component'=>'member/level',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                            [
                                'name'=>'添加',
                                'icon'=>'',
                                'permission'=>'memberLevel:create',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'查看',
                                'icon'=>'',
                                'permission'=>'memberLevel:edit',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'删除',
                                'icon'=>'',
                                'permission'=>'memberLevel:delete',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'保存',
                                'icon'=>'',
                                'permission'=>'memberLevel:update',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'状态',
                                'icon'=>'',
                                'permission'=>'memberLevel:status',
                                'type'=>3,
                                'status'=>1,
                            ],
                        ]
                    ]
                ]
            ],
            [
                'name'=>'应用',
                'icon'=>'component',
                'path'=>'/app',
                'redirect'=>'/app/code',
                'component'=>'#',
                'type'=>1,
                'status'=>1,
                "children"=>[
                    [
                        'name'=>'代码生成',
                        'icon'=>'',
                        'path'=>'code',
                        'permission'=>'code',
                        'component'=>'app/code',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                            [
                                'name'=>'保存',
                                'icon'=>'',
                                'permission'=>'code:update',
                                'type'=>3,
                                'status'=>1,
                            ],
                        ]
                    ],
                    [
                        'name'=>'定时任务',
                        'icon'=>'',
                        'path'=>'crontab',
                        'permission'=>'crontab',
                        'component'=>'app/crontab/index',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                            [
                                'name'=>'添加',
                                'icon'=>'',
                                'permission'=>'crontab:create',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'查看',
                                'icon'=>'',
                                'permission'=>'crontab:edit',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'保存',
                                'icon'=>'',
                                'permission'=>'crontab:update',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'删除',
                                'icon'=>'',
                                'permission'=>'crontab:delete',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'状态',
                                'icon'=>'',
                                'permission'=>'crontab:status',
                                'type'=>3,
                                'status'=>1,
                            ],
                        ]
                    ],
                    [
                        'name'=>'区域',
                        'icon'=>'',
                        'path'=>'region',
                        'permission'=>'region',
                        'component'=>'app/region',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                            [
                                'name'=>'添加',
                                'icon'=>'',
                                'permission'=>'region:create',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'查看',
                                'icon'=>'',
                                'permission'=>'region:edit',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'保存',
                                'icon'=>'',
                                'permission'=>'region:update',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'删除',
                                'icon'=>'',
                                'permission'=>'region:delete',
                                'type'=>3,
                                'status'=>1,
                            ],
                        ],
                    ],
                ]
            ],
            [
                'name'=>'设置',
                'icon'=>'el-icon-setting',
                'path'=>'/system',
                'component'=>'#',
                'type'=>1,
                'status'=>1,
                "children"=>[
                    [
                        'name'=>'微信配置',
//                        'icon'=>'wechat',
                        'path'=>'weixin',
                        'permission'=>'weixin',
                        'redirect'=>'/system/weixin/wechat',
                        'type'=>2,
                        'status'=>1,
                        'component'=>'##',
                        "children"=>[
                            [
                                'name'=>'公众号配置',
                                'icon'=>'',
                                'path'=>'wechat',
                                'permission'=>'weixin:wechat',
                                'component'=>'weixin/wechat',
                                'type'=>2,
                                'status'=>1,
                                "children"=>[
                                    [
                                        'name'=>'保存',
                                        'icon'=>'',
                                        'type'=>3,
                                        'status'=>1,
                                    ],
                                ]
                            ],
                            [
                                'name'=>'小程序配置',
                                'icon'=>'',
                                'path'=>'wxapp',
                                'permission'=>'weixin:wxapp',
                                'component'=>'weixin/wxapp',
                                'type'=>2,
                                'status'=>1,
                                "children"=>[
                                    [
                                        'name'=>'保存',
                                        'icon'=>'',
                                        'type'=>3,
                                        'status'=>1,
                                    ],
                                ]
                            ],
                            [
                                'name'=>'支付配置',
                                'icon'=>'',
                                'path'=>'pay',
                                'permission'=>'weixin:pay',
                                'component'=>'weixin/pay',
                                'type'=>2,
                                'status'=>1,
                                "children"=>[
                                    [
                                        'name'=>'保存',
                                        'icon'=>'',
                                        'type'=>3,
                                        'status'=>1,
                                    ],
                                ]
                            ]
                        ]
                    ],
                    [
                        'name'=>'上传设置',
                        'icon'=>'',
                        'path'=>'attachment',
                        'permission'=>'attachment',
                        'component'=>'system/attachment',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                            [
                                'name'=>'保存',
                                'icon'=>'',
                                'type'=>3,
                                'status'=>1,
                            ],
                        ]
                    ],
                    [
                        'name'=>'系统设置',
                        'icon'=>'',
                        'path'=>'settings',
                        'permission'=>'settings',
                        'component'=>'system/settings',
                        'type'=>2,
                        'status'=>1,
                        "children"=>[
                            [
                                'name'=>'添加',
                                'icon'=>'',
                                'permission'=>'settings:create',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'查看',
                                'icon'=>'',
                                'permission'=>'settings:edit',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'保存',
                                'icon'=>'',
                                'permission'=>'settings:update',
                                'type'=>3,
                                'status'=>1,
                            ],
                            [
                                'name'=>'删除',
                                'icon'=>'',
                                'permission'=>'settings:delete',
                                'type'=>3,
                                'status'=>1,
                            ],
                        ]
                    ],
                ]
            ],
        ];
        $menu = $this->recursion($menu);
        foreach ($menu as $m){
            Menu::create($m);
        }
        dump('菜单添加 success');
        // 角色权限
        for ($i = 0; $i < count($menu); $i++) {
            $role_menu[]=['menu_id' => $menu[$i]['id'],'role_id' => 1];
        }
        \DB::table('role_menu')->insert($role_menu);

        dump('角色权限添加 success');
    }
    protected function recursion($menu, $pid = 0){
        global $res;
        foreach ($menu as &$m){
            global $id;
            if (!$m['id']){
                $m['id'] = ++$id;
            }
            if ($pid){
                $m['pid'] = $pid;
            }
            if (is_array ($m['children']))
            {
                $m['children'] = $this->recursion ($m['children'],$id);
                unset($m['children']);
            }
            $res[] = $m;
        }
        return $res;
    }
}
