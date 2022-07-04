<?php

namespace App\Models\Admin\Member;

use App\Models\Admin\Base;

class Index extends Base
{
    protected $table         = 'member';		                // 为模型指定表名
    protected $primaryKey    = 'id';
    protected $datas = ['deleted_at'];

    protected $fillable = [
        'nickname', 'avatar','level', 'agentid', 'realname', 'mobile', 'password' , 'credit1' ,'credit2','sex','pid','cid','aid','sid','address_info','status','description','create_id'
    ];
    public function level(){
        return $this->hasOne(Level::class, 'id', 'level');
    }
}
