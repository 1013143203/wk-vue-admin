<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MemberLevel extends Model
{
    protected $table         = 'member_level';		                // 为模型指定表名
    protected $primaryKey    = 'id';
    protected $datas = ['deleted_at'];

    protected $fillable = [
        'name','level',
    ];
}
