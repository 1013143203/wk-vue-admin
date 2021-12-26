<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class WeixinController extends Base
{
    public function load($name)
    {
        return success(config("weixin.$name"));
    }
    public function wechat(Request $request)
    {
        $input = $request->only(['appid', 'appsecret','token','pushApi', 'aesKey']);
        modifyConfig('weixin',$input,'wechat');
        return success();
    }
    public function wxapp(Request $request)
    {
        $input = $request->only(['appid', 'appsecret']);
        modifyConfig('weixin',$input,'wxapp');
        return success();
    }
    public function pay(Request $request)
    {
        $input = $request->only(['notify_url', 'mchid','key','apiclient_cert','apiclient_key']);
        modifyConfig('weixin',$input,'pay');
        return success();
    }
}
