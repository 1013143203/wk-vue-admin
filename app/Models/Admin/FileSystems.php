<?php

namespace App\Models\Admin;

class FileSystems extends Base
{
    protected $table         = 'file_systems';		                // 为模型指定表名
    protected $primaryKey    = 'file_id';
    protected $datas = ['deleted_at'];

    protected $fillable = [
        'create_id', 'url','type', 'name', 'ext', 'md5', 'size' , 'storage',
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'create_id');
    }
}
