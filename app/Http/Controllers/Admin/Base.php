<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 跨域问题解决方案
header("Access-Control-Allow-Origin:*");

class Base extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->initConfig();
    }

    public function loadEdit()
    {
        return success($this->service->loadEdit(request()->input()));
    }

    public function initConfig()
    {
        // 请求参数
        $input= request()->input();

        // 分页基础默认值
        defined('LIMIT') or define('LIMIT', isset($input['limit']) ? $input['limit'] : 20);
        defined('PAGE') or define('PAGE', isset($input['page']) ? $input['page'] : 1);

    }

    public function index()
    {
        // $this->cols
        return success($this->service->lists(request()->input()));
    }

    public function status($id,$status)
    {
        $data = [
            'id'=>$id,
            'status'=>$status
        ];
        return success($this->service->status($data),'操作成功');
    }
    public function delete($id)
    {
        return success($this->service->delete($id),'操作成功');
    }
}
