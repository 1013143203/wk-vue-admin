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

        //权限
        $res['permission'] = MenuService::getAllMenus(MenuService::Menus($input));
        return $res;
    }
    public function create(array $input)
    {
        if($id = parent::create($input)){
            if ($permission=@$input['permission']){
                self::permission($id,$permission);
            }
        }
    }
    public function permission($id,$permission){
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
        self::permission($input['id'],$permission);
        parent::update($input);
    }
    public function edit($id)
    {
        $data = $this->model
            ->whereQ(function ($query) use ($id){
                $query->where('id',$id);
            })
            ->withQ('menu')
            ->getByItem();
        $data['menu']=array_column($data['menu'], 'id')??[];
        return $data;
    }
}
