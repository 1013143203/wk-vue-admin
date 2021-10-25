<?php
    Class Elemen{

        const BASE_URL = 'https://open-api.shop.ele.me/';
        const REDIRECT_URL = 'https://open-api.shop.ele.me/';

        private $client_id;
        private $secret;
        private $log;

        public function __construct($client_id ,$secret)
        {
            $this->client_id = $client_id;
            $this->secret = $secret;

            $this->log = new Logging();
        }

        public function getToken(){
            $filename = "./token.json";

            if (!file_exists($filename)){
                file_put_contents($filename,'');
            }
            $data = json_decode(file_get_contents($filename));
            if (!$data && !$_GET['code']){
                file_put_contents($filename,'');
                $this->codeUri();
            }

            if ($data && $data['expires_in_time'] < time()-30){
                $this->log->lwrite('access_token过期：' . json_encode($data,JSON_UNESCAPED_UNICODE ));
                $this->refreshToken($data['refresh_token']);
                $data = json_decode(file_get_contents($filename));
            }
            return $data;
        }

        protected function setToken($options,$grant_type){
            $url = self::BASE_URL.'token';

            $res = $this->curlPost($url,$options,array(
                    'Authorization:Basic '.base64_encode($this->client_id . ":" . $this->secret),
                    "Content-Type: application/x-www-form-urlencoded"
                )
            );
            $this->log->lwrite("获取access_token:{$res}");
            if ($data = json_decode($res,true)){
                if ($grant_type=='code'){
                    unlink("./token.json");
                }
                $data['expires_in_time'] = $data['expires_in'] + time();
                file_put_contents("./token.json",json_encode($data,JSON_UNESCAPED_UNICODE ));
            }
        }

        protected function refreshToken($refresh_token){

            $options=array(
                "grant_type"=>'refresh_token',
                "refresh_token"=>$refresh_token,
            );

            $this->setToken($options,'refresh_token');
        }
        protected function codeUri(){
            $redirect_uri = urlencode(self::REDIRECT_URL);
            $url = self::BASE_URL."authorize?client_id={$this->client_id}&redirect_uri={$redirect_uri}&scope=all&state=weiweiwei&response_type=code";
            header("location:{$url}");
        }
        public function getCode(){
            $this->log->lwrite('获取code：' . $_GET['code']);
            if ($_GET['code']){
                $options=array(
                    "grant_type"=>'authorization_code',
                    "code"=>$_GET['code'],
                    "redirect_uri"=>self::REDIRECT_URL,
                    "client_id"=>$this->client_id,
                );
                $this->setToken($options,'code');
            }
        }

        public function getOrder(){
            $url = self::BASE_URL.'api/v1/';
            $orderId=123;
            $token_data = $this->getToken();
            $token = $token_data['access_token'];
            $action = "eleme.order.getOrder";
            $options=array(
                "nop"=>'1.0.0',
                "id"=>time(),
                "metas"=>json_encode(array(
                    "app_key"=>$this->client_id,
                    "timestamp"=>time(),
                )),
                "action"=>$action,
                "token"=>$token,
                "params"=>json_encode(array(
                    'orderId'=>$orderId,
                )),
                "signature"=>$this->signature($orderId,$token,$action),
                'orderId'=>$orderId,
            );
            $res = $this->curlPost($url,$options,array(
                    "Content-Type: application/json;charset=utf-8"
                )
            );
            $this->log->lwrite("获取订单参数:".json_encode($options,JSON_UNESCAPED_UNICODE));
            $this->log->lwrite("获取订单详情:{$res}");
            var_dump($res);die;
        }

        protected function signature($orderId,$token,$action){
            $data = [
                "orderId" => $orderId,
                "app_key" => $this->client_id,
                "timestamp" => time()
            ];
            $data = array_filter($data);
            $str='';
            foreach ($data as $k => $v){
                $str .= $k.$v;
            }
            $string_sign_temp = $action . '"'. $token .'"' . $str . $this->secret;
            $sign = md5($string_sign_temp);
            return strtoupper($sign);
        }


        protected function curlGet($url = '', $options = array(), $header = array())
        {
            $request_url = $url . '?' . http_build_query($options);
            $ch = curl_init($request_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);

            //https请求 不验证证书和host
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            if ($header){
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            }

            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        public function curlPost($url = '', $options = array(), $header = array())
        {
            $request_url = $url . '?' . http_build_query($options);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $request_url);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($header){
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            }
            $response = curl_exec($curl);
            if (curl_error($curl)) {
                $error_msg = curl_error($curl);
                $error_no = curl_errno($curl);
                curl_close($curl);
                throw new \Exception($error_msg, $error_no);
            }
            curl_close($curl);
            return $response;
        }
    }