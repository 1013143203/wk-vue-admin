<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class AdminException extends Exception
{
    protected $msg =array(
        401 => '操作失败',
        402 => '密码错误！',
        403 => '账号已被锁定请联系管理员',
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

