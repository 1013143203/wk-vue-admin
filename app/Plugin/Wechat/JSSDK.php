<?php
class JSSDK
{
    private $appId;
    private $appSecret;
    private $ticketUri;
    private $tokenUri;


    public function __construct($appId, $appSecret, $enterprise = false) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        if ($enterprise){
            //如果是企业号
            $this->ticketUri = 'https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token={{ACCESSTOKEN}}';
            $this->tokenUri = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid={{APPID}}&corpsecret={{APPSECRET}}';
        }else{
            $this->ticketUri = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token={{ACCESSTOKEN}}';
            $this->tokenUri = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={{APPID}}&secret={{APPSECRET}}';
        }
    }

    public function getSignPackage($url) {
        $jsapiTicket = $this->getJsApiTicket();

        $timestamp = time();
        $nonceStr = createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }
    protected function getJsApiTicket() {
        $jsapi_ticket_file = dirname(__FILE__)."/json/wechat/jsapi_ticket.json";
        $data = json_decode(file_get_contents($token_file));
        if ($data->expire_time < time() || !$data) {
            $accessToken = $this->getAccessToken();
            $url = str_replace('{{ACCESSTOKEN}}',$accessToken,$this->ticketUri);
            $res = json_decode(curl_get($url));
            $ticket = $res->ticket;
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                file_put_contents($jsapi_ticket_file, json_encode($data));
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }

        return $ticket;
    }

    private function getAccessToken() {
        $access_token_file = dirname(__FILE__)."/json/wechat/access_token.json";
        $data = json_decode(file_get_contents($access_token_file));
        if (empty($data) || $data->expire_time < time()) {
            // 如果是企业号用以下URL获取access_token
            $url = str_replace([
                '{{APPID}}',
                '{{APPSECRET}}',
            ],[
                $this->appId,
                $this->appSecret,
            ],$this->tokenUri);
            $res = json_decode(curl_get($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data = new stdClass();
                $data->expire_time = time() + 4000;
                $data->access_token = $access_token;
                file_put_contents($access_token_file, json_encode($data));
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

}
