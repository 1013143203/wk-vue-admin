<?php

namespace App\Services\Admin;

use App\Exceptions\Exception;
use App\Exceptions\AdminException;
use App\Models\Admin\UserRole;
use App\Services\Admin\BaseService;
use App\Models\Admin\User;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Hash;


class UserService extends BaseService
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function lists(array $input)
    {
        $res = $this->model
            ->selectQ(['id','username','status'])
            ->whereQ(function($query) use ($input){
                // 按照名称进行搜索
                if (!empty($input['username'])){
                    $query->where('username', 'LIKE', '%' . trim($input['username']) . '%');
                }
                if (!empty($input['date'])){
                    $query->whereBetween('created_at', $input['date']);
                }
            })
            ->withQ('role')
            ->paginate(PAGE,LIMIT)
            ->getAll();
        foreach ($res['lst'] as &$v){
            $role='';
            foreach ($v['role'] as $r){
                $role.=$r['name'].' | ';
            }
            if ($v['id']==1){
                $v['hidden'] = true;
            }
            $v['role']=trim($role,' |');
        }

        //角色
        $roleModel = new Role();
        $rolelst = $roleModel->selectQ(['id as value','name as label'])
            ->whereQ(function ($query){
                $query->where('status',1);
            })
            ->getAll(false);

        $res['rolelst'] = $rolelst;
        return $res;
    }
    public function edit($id)
    {
        $res = $this->model->withQ(['role'=>function($query){
            $query->where('status',1);
        }])->whereQ(['id'=>$id])->getItem();
        $res['role']=array_column($res['role'], 'id');

        return $res;
    }
    public function role($id,$role){
        $roleModel = new Role();
        $userRoleModel = new UserRole();
        $rolelst = $roleModel->selectQ(['id as value','id','name as label'])->getAll(false);
        $role_ids = array_column($rolelst, 'id');

        $role_intersect=array_intersect($role_ids,$role);
        $role_diff=array_diff($role_ids,$role);

        //处理选中的(交接)
        foreach ($role_intersect as $r_i){
            if(!$userRoleModel->whereUserId($id)->whereRoleId($r_i)->first()){
                $userRoleModel->create(['role_id'=>$r_i,'user_id'=>$id]);
            }
        }
        //处理未选中的(差集)
        foreach ($role_diff as $r_d){
            $userRoleModel->whereUserId($id)->whereRoleId($r_d)->delete();
        }
    }
    public function update(array $input)
    {
        $role = isset($input['role']) ? $input['role'] : "";
        self::role($input['id'],$role);
        unset($input['username']);
        if(!$input['password'] || empty($input['password']))
            unset($input['password']);
        else
            $input['password']=Hash::make($input['password']);

        parent::update($input);
    }
    public function create(array $input)
    {
        $input['password']=Hash::make($input['password']);
        if($id = parent::create($input)){
            if ($role=@$input['role']){
                self::role($id,$role);
            }
        }
    }
}
