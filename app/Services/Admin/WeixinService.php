<?php

namespace App\Services\Admin;



class WeixinService extends BaseService
{
//    public function __construct(User $user)
//    {
//        $this->model = $user;
//    }
    public function wechat(array $input)
    {
        modifyConfig('weixin',[
            'wechat'=>[
                'Token'=>213132,
                'AppId'=>213132,
                'AppSecret'=>213132,
                'AesKey'=>213132,
                'PushApi'=>213132,
            ]
        ]);
    }
}
