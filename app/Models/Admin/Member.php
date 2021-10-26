<?php

namespace App\Models\Admin;

class Member extends Base
{
    protected $table         = 'member';		                // 为模型指定表名
    protected $primaryKey    = 'id';
    protected $datas = ['deleted_at'];

    protected $fillable = [
        'nickname', 'avatar','level', 'agentid', 'realname', 'mobile', 'password' , 'credit1' ,'credit2','sex','pid','cid','aid','sid','address_info','status','description',
    ];
    public function level(){
        return $this->hasOne(MemberLevel::class, 'id', 'level');
    }
}
