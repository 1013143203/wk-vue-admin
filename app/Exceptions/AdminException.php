<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class AdminException extends Exception
{
    protected $msg =array(
        201 => '操作失败',
        202 => '密码错误！',
        203 => '账号已被锁定请联系管理员',
        204 => '验证未通过',
    );
    public function __construct($code,$msg='')
    {
        if(empty($msg)){
            $msg=$this->msg[$code];
        }
        parent::__construct($msg, $code);
    }
    public function render()
    {
        return response()->json([
            'code' => $this->getCode(),
            'msg' => $this->getMessage(),
        ]);
    }
}

