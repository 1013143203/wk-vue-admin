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
    public function wechat(Request $request)
    {
        return success($this->service->wechat($request->input()));
    }
}
