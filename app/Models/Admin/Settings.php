<?php

namespace App\Models\Admin;

class Settings extends Base
{
    protected $table         = 'settings';		                // 为模型指定表名
    protected $primaryKey    = 'id';

    protected $fillable = [
        'name', 'value', 'desc', 'description'
    ];
}
