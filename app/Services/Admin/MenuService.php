<?php
namespace App\Services\Admin;

use App\Exceptions\AdminException;
use App\Models\Admin\Menu;
use App\Models\Admin\RoleMenu;

class MenuService extends BaseService
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }
    public function loadEdit()
    {
        $res['menus_nodes']=config('admin.menus_nodes');
        $res['menus_types']=config('admin.menus_types');
        $category = $this->model->where('type','<',3)->get()->toArray();
        array_unshift($category, ['name'=>'顶级分类','id'=>0]);
        $res['category']=$category;
    }
    public static function Menus($input = []){
        $menu = Menu::where(function ($query){
                if(isset($input['name'])){
                    $query -> where('name', 'like', '%'.$input['name'].'%');
                }
            })
            ->get(['id','name as label','pid','type','status','icon','permission','path'])
            ->toArray();
        foreach ($menu as &$m){
            if ($m['type']==3){
                $m['hidden']=true;
            }
        }
        return $menu;
    }
    public function lists(array $input)
    {
        return self::getAllMenus(self::Menus($input));
    }
    public static function getAllMenus($array, $pid =0){
        $arr = array();
        foreach ($array as $key => &$value) {
            $value['type_']=config('admin.menus_types')[$value['type']-1]['name'];
            if ($value['pid'] == $pid) {
                $id = $value['id'];
                unset($array[$key]);
                if($children=self::getAllMenus($array, $id)) {
                    $value['children']=$children;
                }
                $arr[] = $value;
            }
        }
        return $arr;
    }
    public function edit($id)
    {
        $res=parent::edit($id);
        $res['node_fun']=[];
        if($res['type']==2){
            $result = $this->model->wherePid($id)->get()->toArray();
            $menus_nodes=config('admin.menus_nodes');
            foreach ($result as $v){
                $permission=explode(':',$v['permission']);
                $per=$permission[count($permission)-1];
                foreach ($menus_nodes as $n){
                    if($n['data']==$per){
                        $res['node_fun'][]=$n['id'];
                    }
                }
            }
        }
        return $res;
    }
    public function create(array $input)
    {

        if($input['type']==1){
            $input['path']=trim($input['path']);
            $frist_path = substr( $input['path'], 0, 1 );
            if($frist_path!='/'){
                $input['path']='/'.$input['path'];
            }
        }
        if($input['type']==3){
            $permission = $this->model->where('id',request('pid'))->value('permission');
            $input['permission'] = $permission.':'.request('permission');
        }

        $id = parent::create($this->model->setFilterFields($input));
        $this->role_menu_create($id);

        if($input['type']==2 && isset($input['node_fun'])){//如果节点存在
            foreach ($input['node_fun'] as $v){
                foreach (config('admin.menus_nodes') as $c){
                    if($c['id']==$v){
                        $child_permission=$input['permission'].":{$c['data']}";
                        if(!$this->model->where('permission',$child_permission)->first()){
                            $child_id = self::createnodesData($id,$c['name'],$child_permission);
                            $this->role_menu_create($child_id);
                        }
                    }
                }

            }
        }
    }
    protected function createnodesData($pid,$name,$permission){
        $child['name']=$name;
        $child['pid']=$pid;
        $child['type']=3;
        $child['status']=1;
        $child['permission']=$permission;
        return parent::create($child);
    }
    protected function role_menu_create($id){
        $roleMenuModel = new RoleMenu();
        if(!$roleMenuModel->whereMenuId($id)->whereRoleId(1)->first()){
            $roleMenuModel->create(['menu_id'=>$id,'role_id'=>1]);
        }
    }
    public function update(array $input){

        $node_fun = isset($input['node_fun']) ? $input['node_fun'] : [];

        // 节点参数
        $menus_nodes=config('admin.menus_nodes');
        $node_ids = array_column($menus_nodes, 'id');
        $node_intersect=array_intersect($node_ids,$node_fun);
        $node_diff=array_diff($node_ids,$node_fun);
        //处理选中的(交接)
        foreach ($node_intersect as $n_i){
            $node_permission=$input['permission'].':'.$menus_nodes[--$n_i]['data'];
            if(!$this->model->wherePermission($node_permission)->first()){
                self::createnodesData($input['id'],$menus_nodes[$n_i]['name'],$node_permission);
            }
        }
        //处理未选中的(差集)
        foreach ($node_diff as $n_d){
            $node_permission=$input['permission'].':'.$menus_nodes[--$n_d]['data'];
            $this->model->wherePermission($node_permission)->delete();
        }

        if($input['type']==1){
            if(substr(trim($input['path']), 0, 1 )!='/'){
                $input['path']='/'.$input['path'];
            }
        }
        parent::update($input);
    }
    public function delete($id){
        $ids = $this->children($id);
        $ids[] = $id;
        $this->model->delItem($ids);
    }
    protected function children($id){
        global $ids;
        $res = $this->model->where(['pid'=>$id])->get(['id']);
        if ($res){
            foreach ($res as $v){
                $ids[] = $v['id'];
                $this->children($v['id']);
            }
        }
        return $ids;
    }
}
