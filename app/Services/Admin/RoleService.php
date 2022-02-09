<?php

namespace App\Services\Admin;

use App\Exceptions\Exception;
use App\Exceptions\AdminException;
use App\Models\Admin\Role;
use App\Models\Admin\Menu;
use App\Models\Admin\RoleMenu;


class RoleService extends BaseService
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }
    public function lists(array $input)
    {
        $res = $this->model->selectQ(['id','name','status'])
            ->whereQ(function($query) use ($input){
            // 按照名称进行搜索
            if (!empty($input['username'])){
                $query->where('name', 'LIKE', '%' . trim($input['username']) . '%');
            }
        })->paginate(PAGE,LIMIT)->getAll();
        foreach ($res['lst'] as &$v){
            if ($v['id']==1){
                $v['hidden'] = true;
            }
        }

        return $res;
    }
    public function permission($id)
    {
        $res = $this->edit($id);
        return [
            'permission_list'=>MenuService::getAllMenus(MenuService::Menus()),
            'permission'=>$res['menu']
        ];
    }

    public function create(array $input)
    {
        if($id = parent::create($input)){
            if ($permission=$input['permission']){
                self::updatePermission($id,$permission);
            }
        }
    }
    protected function updatePermission($id,$permission){
        $roleMenuModel = new RoleMenu();

        $menu_ids = array_column(MenuService::Menus(), 'id');
        $auth_intersect=array_intersect($menu_ids,$permission);
        $auth_diff=array_diff($menu_ids,$permission);

        //处理选中的(交接)
        foreach ($auth_intersect as $a_i){
            if(!$roleMenuModel->whereMenuId($a_i)->whereRoleId($id)->first()){
                $roleMenuModel->create(['menu_id'=>$a_i,'role_id'=>$id]);
            }
        }
        //处理未选中的(差集)
        foreach ($auth_diff as $a_d){
            $roleMenuModel->whereMenuId($a_d)->whereRoleId($id)->delete();
        }
    }
    public function update(array $input)
    {
        $permission = isset($input['permission']) ? $input['permission'] : [];
        self::updatePermission($input['id'],$permission);
        parent::update($input);
    }
    public function edit($id)
    {
        $data = $this->model
            ->where(function ($query) use ($id){
                $query->where('id',$id);
            })
            ->with('menu')
            ->first()->toArray();
        $data['menu']=array_column($data['menu'], 'id')??[];
        return $data;
    }
}
