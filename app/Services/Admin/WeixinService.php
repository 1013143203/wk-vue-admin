<?php

namespace App\Services\Admin;

class WeixinService extends BaseService
{
    public function wechat(array $input)
    {
        modifyConfig('weixin','wechat',$input);
    }
    public function wxapp(array $input)
    {
        modifyConfig('weixin','wxapp',$input);
    }
    public function pay(array $input)
    {
        modifyConfig('weixin','pay',$input);
    }
}
