<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Admin\WeixinService;

class WeixinController extends Base
{
    public function __construct(WeixinService $weixinService)
    {
        parent::__construct();
        $this->service = $weixinService;
    }
    public function load($name)
    {
        return success(config("weixin.$name"));
    }
    public function wechat(Request $request)
    {
        return success($this->service->wechat($request->only(['appid', 'appsecret','token','pushApi', 'aesKey'])));
    }
    public function wxapp(Request $request)
    {
        return success($this->service->wxapp($request->only(['appid', 'appsecret'])));
    }
    public function pay(Request $request)
    {
        return success($this->service->pay($request->only(['appid', 'appsecret'])));
    }
}
