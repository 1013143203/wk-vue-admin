<?php

namespace App\Models\Admin;

class RoleMenu extends Base
{
    public $timestamps = false;
    protected $table         = 'role_menu';		                // 为模型指定表名
    protected $primaryKey    = 'id';
    protected $fillable = [
        'role_id', 'menu_id'
    ];
}
