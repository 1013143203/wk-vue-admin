<?php

class Api{

    protected $appId='666666666666666666666';
    protected $appSecret='9d682649d9f64faeb5e4477a8e27858e';
    protected $parkId = 1039;
    private $isDebug = true;
    const SMS_URL = 'http://dx.ganso.com.cn/';     //正式
    const SMS_URL_TEST = 'https://tsktapps.keytop.cn/unite-api/';//测试

    public function __construct()
    {
//        isDebug
    }

    public function GetKey($data, $appSecret){
        ksort($data);

        $str = http_build_query($data)."&{$appSecret}";

        $str = urldecode($str);

        return strtoupper(md5($str));
    }
    public function filter(array $data){
        return array_filter($data, function ($v, $k) {
            if ($v === '' || is_array($v)) {
                return false;
            }
            return true;
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function curlPost($url = '', $postData = '', $header = array("Content-Type: application/json;charset=UTF-8", "version:1.0.0"))
    {
        if (is_array($postData)) {
            $postData = http_build_query($postData);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //设置cURL允许执行的最长秒数

        if ( !empty($header) ) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        //https请求 不验证证书和host
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);
        if (intval($info["http_code"]) == 200) {
            return $data;
        } else {
            return false;
        }
    }

    public function getParkingPaymentInfo( array $data){
        $url = (($this->isDebug)  ? self::SMS_URL_TEST : self::SMS_URL);
        $url= $url.'api/wec/GetParkingPaymentInfo';

        $param= $this->filter(array(
            'parkId'=>$this->parkId,//车场Id
            'serviceCode'=>'getParkingPaymentInfo',
            'ts'=>time(),//时间戳
            'reqId'=>time(),//每次请求的唯一标识,
            'plateNo'=>$data['plateNo'],//车牌号
            'cardNo'=>$data['cardNo'],//入场取票号/无牌车入场的卡号
            'deviceCode'=>$data['deviceCode'],//设备编码(出口) 设备编码仅支持出口有停放车辆,并识别正确的情况不支持无牌车
            'freeTime'=>$data['freeTime']?(int) $data['freeTime']:'',//免费时长（秒）
            'freeMoney'=>$data['freeMoney']?(int) $data['freeMoney']:'',//免费金额（单位:分）
        ));
        $this->log(json_encode($param),"key加密字段");

        $param['key'] = $this->GetKey($param, $this->appSecret);
        $param['appId']=$this->appId;
        $this->log(json_encode($param),"读取接口 {$url}");
        $json = $this->curlPost($url, json_encode($param));

        $this->log($json,'返回值');
        $res = json_decode($json,true);
        if ($json && $res['resCode']==0){
            $res['data']=json_decode($res['data'],true);
        }
        return $res;
    }
    public function log($data, $title='', $isEncode=true) {
        //设置目录时间
        $years = date('Y-m-d');
        //设置路径目录信息
        $url  = './apilog/'.$years.'.log';
        //取出目录路径中目录(不包括后面的文件)
        $dir_name = dirname($url);
        //如果目录不存在就创建
        if(!file_exists($dir_name)) {
            //iconv防止中文乱码
            $res = mkdir(iconv("UTF-8","GBK",$dir_name),0777,true);
        }

        if($isEncode==true){
            $content = json_encode($data);
        }else{
            $content =$data;
        }

        $now_time= time();
        $now_date= date('Y-m-d H:i:s',$now_time);
        $content = "\n\n\n".$now_date.'  '.$title."\n".$content;
        file_put_contents($url, $content,FILE_APPEND);
    }
}

$api = new Api();
$data=array(
    'plateNo'=>'苏A80001',//车牌号
);
$res=$api->getParkingPaymentInfo($data);

var_dump($res);die;