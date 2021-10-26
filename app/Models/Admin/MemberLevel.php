<?php

namespace App\Models\Admin;


class MemberLevel extends Base
{
    protected $table         = 'member_level';		                // 为模型指定表名
    protected $primaryKey    = 'id';
    protected $datas = ['deleted_at'];

    protected $fillable = [
        'name','level','status'
    ];
}
