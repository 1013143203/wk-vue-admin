<?php

namespace App\Models\Admin\Member;

use App\Models\Admin\Base;

class Level extends Base
{
    protected $table         = 'member_level';		                // 为模型指定表名
    protected $primaryKey    = 'id';
    protected $datas = ['deleted_at'];

    protected $fillable = [
        'name','level','status','create_id'
    ];
}
