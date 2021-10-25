<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Base
{
    use SoftDeletes;

    protected $table         = 'settings';		                // 为模型指定表名
    protected $primaryKey    = 'id';
    protected $datas = ['deleted_at'];

    protected $fillable = [
        'name', 'value', 'desc', 'description'
    ];
}
