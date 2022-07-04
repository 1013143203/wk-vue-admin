<?php

namespace App\Models\Admin;

class Role extends Base
{
    protected $table         = 'role';		                // 为模型指定表名
    protected $primaryKey    = 'id';

    protected $fillable = [
        'name', 'status' ,'description','create_id'
    ];

    public function menu(){
        return $this->belongsToMany(Menu::Class, 'role_menu','role_id','menu_id');
    }
}
