<?php

namespace App\Services\Admin;

use App\Exceptions\AdminException;
use App\Models\Admin\Menu;
use App\Models\Admin\User;
use App\Models\Admin\UserRole;
use App\Models\Admin\UserActionLog;

class AuthService extends BaseService
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function login(){
        $credentials = request(['username', 'password']);
        if (! $token = auth('admin')->attempt($credentials)) {
            throw new AdminException(202);
        }
        $user=auth('admin')->user();
        if($user['status']==2){
            throw new AdminException(203);
        }
        UserActionLog::record($user->id,'登陆成功');

        return $token;
    }
    public function getAuths(int $id){
        $auths=[];
        $res = self::selectSql($id,'permission');
        foreach ($res as $r){
            if($r['permission']) $auths[]=$r['permission'];
        }
        return $auths;
    }
    protected function selectSql($id , $field="*" ,$type=0){
        return UserRole::select('menu.'.$field)
            ->where('user_role.user_id',$id)
            ->where('menu.type','<>',$type)
            ->join('role', 'role.id', '=', 'user_role.role_id')
            ->join('role_menu', 'role.id', '=', 'role_menu.role_id')
            ->join('menu', 'menu.id', '=', 'role_menu.menu_id')
            ->distinct()
            ->get()->toArray()
        ;
    }
    public function getRouters(int $id){
        $res = self::selectSql($id,'*',3);
        $menu_ids=[];
        $menu=[];
        foreach ($res as $v){
            if (!in_array($v['id'],$menu_ids)){
                if(!empty($v['pid'])){
                    $v['meta']['auth'][]=$v['permission'];
                }
                $v['path'] = !$v['path']?'#':$v['path'];
                $v['meta']['title']=$v['name'];
                $v['meta']['icon']=$v['icon'];
                $menu[]=$v;
            }else{
                $menu_ids[]=$v['id'];
            }
        }

        $lst=MenuService::getAllMenus($menu);
        return $lst;
    }
    public function logout(){
        auth('admin')->logout();
        return ['code'=>200,'msg' => '已注销'];
    }
}
