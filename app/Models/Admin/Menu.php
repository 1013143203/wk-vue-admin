<?php

namespace App\Models\Admin;

class Menu extends Base
{
    protected $table         = 'menu';		                // 为模型指定表名
    protected $primaryKey    = 'id';

    protected $fillable = [
        'name', 'pid', 'icon', 'path', 'type', 'component' , 'redirect' , 'permission' ,'status' ,'is_public' ,'description','create_id'
    ];

    public function role(){
        return $this->belongsToMany(\App\Models\Admin\Role, 'role_route','route_id','role_id');
    }
}
