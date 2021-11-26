<?php

/**
 * 获取客户端IP地址
 * @param int $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param bool $adv 否进行高级模式获取（有可能被伪装）
 * @return mixed 返回IP
 * @author 喂喂喂
 */
function get_client_ip(){
    //判断服务器是否允许$_SERVER
    if(isset($_SERVER)){
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }else{
            $realip = $_SERVER['REMOTE_ADDR'];
        }
    }else{
        //不允许就使用getenv获取
        if(getenv("HTTP_X_FORWARDED_FOR")){
              $realip = getenv( "HTTP_X_FORWARDED_FOR");
        }elseif(getenv("HTTP_CLIENT_IP")) {
              $realip = getenv("HTTP_CLIENT_IP");
        }else{
              $realip = getenv("REMOTE_ADDR");
        }
    }

    return $realip;
}

if ( !function_exists('array_merge_multiple') ) {
    /**
     * 多维数组合并
     *
     * @param $array1
     * @param $array2
     *
     * @return array
     */
    function array_merge_multiple($array1, $array2)
    {
        $merge = $array1 + $array2;
        $data = [];
        foreach ($merge as $key => $val) {
            if ( isset($array1[$key]) && is_array($array1[$key]) && isset($array2[$key]) && is_array($array2[$key]) ) {
                $data[$key] = array_merge_multiple($array1[$key], $array2[$key]);
            } else {
                $data[$key] = isset($array2[$key]) ? $array2[$key] : $array1[$key];
            }
        }
        return $data;
    }
}


/**
 * 输出xml字符
 */
function array_to_xml($arr = [])
{
    if ( !is_array($arr) || count($arr) <= 0 ) {
        exception("数组数据异常！");
    }

    $xml = "<xml>";
    foreach ($arr as $key => $val) {
        if ( is_numeric($val) ) {
            $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
        } else {
            $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
    }
    $xml .= "</xml>";
    return $xml;
}

/**
 * 将xml转为array
 */
function xml_to_array($xml)
{
    if ( !$xml ) {
        \Exception("xml数据异常！");
    }

    // 解决部分json数据误入的问题
    $arr = json_decode($xml, true);
    if ( is_array($arr) && !empty($arr) ) {
        return $arr;
    }
    // 将XML转为array
    $arr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $arr;
}

if ( !function_exists('get_month_range') ) {
    /**
     * 指定日期范围之内的所有月份
     *
     * @param  string  $start_date  开始日期
     * @param  string  $end_date    结束日期
     * @param  string  $format      返回格式
     *
     * @return array
     */
    function get_month_range(string $start_date, string $end_date, string $format = 'Y-m')
    {
        $end = date($format, strtotime($end_date)); // 转换为月
        $range = [];
        $i = 0;
        do {
            $month = date($format, strtotime($start_date . ' + ' . $i . ' month'));
            $range[] = $month;
            $i++;
        } while ( $month < $end );
        return $range;
    }
}

if ( !function_exists('get_year_range') ) {
    function get_year_range(string $start_date, string $end_date, string $format = 'Y')
    {
        $end = date($format, strtotime($end_date)); // 转换为月
        $range = [];
        $i = 0;
        do {
            $month = date($format, strtotime($start_date . ' + ' . $i . ' year'));
            $range[] = $month;
            $i++;
        } while ( $month < $end );
        return $range;
    }
}

if ( !function_exists('get_month_days') ) {
    /**
     * 获取某月份的所有日期列表
     *
     * @param  string  $time
     * @param  string  $format
     *
     * @return array
     */
    function get_month_days($time = '', $format = 'Y-m-d')
    {
        $time = $time != '' ? strtotime($time) : time();
        //获取当前周几
        $week = date('d', $time);
        $date = [];
        for ($i = 1; $i <= date('t', $time); $i++) {
            $date[$i] = date($format, strtotime('+' . $i - $week . ' days', $time));
        }
        return $date;
    }
}

if ( !function_exists('get_days_range') ) {
    /**
     * 指定日期范围之内的所有天
     *
     * @param  string  $start_date  开始日期
     * @param  string  $end_date    结束日期
     * @param  string  $format      返回格式
     *
     * @return array
     */
    function get_days_range(string $start_date, string $end_date, string $format = 'Y-m-d')
    {
        $end = date($format, strtotime($end_date)); // 转换为月
        $range = [];
        $i = 0;
        do {
            $day = date($format, strtotime($start_date . ' + ' . $i . ' day'));
            $range[] = $day;
            $i++;
        } while ( $day < $end );
        return $range;
    }
}


if ( !function_exists('filtering_html_tags') ) {
    /**
     * 过滤HTML的标签，只保留文本
     *
     * @param $string
     *
     * @return string
     */
    function filtering_html_tags($string)
    {
        return strip_tags(htmlspecialchars_decode($string), '');
    }
}

if ( !function_exists('get_client_info') ) {
    /**
     * 获取IP与浏览器信息、语言
     *
     * @return array
     */
    function get_client_info() : array
    {
        if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
            $XFF = $_SERVER['HTTP_X_FORWARDED_FOR'];
            $client_pos = strpos($XFF, ', ');
            $client_ip = false !== $client_pos ? substr($XFF, 0, $client_pos) : $XFF;
            unset($XFF, $client_pos);
        } else $client_ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? $_SERVER['LOCAL_ADDR'] ?? '0.0.0.0';
        $client_lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5) : '';
        $client_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        return [
            'ip'    => &$client_ip,
            'lang'  => &$client_lang,
            'agent' => &$client_agent,
        ];
    }
}

function curl_post($url, $headers, $params){
    return curlRequest($url,'POST',$headers,$params);
}
function curl_get($url, $headers, $params){
    return curlRequest($url,'GET',$headers,$params);
}
/**
 * 提交数据
 * @param  string $url 请求Url
 * @param  string $method 请求方式
 * @param  array/string $headers Headers信息
 * @param  array/string $params 请求参数
 * @return 返回的
 */
function curlRequest($url, $method, $headers, $params){
    if (is_array($params)) {
        $requestString = http_build_query($params);
    } else {
        $requestString = $params ? : '';
    }
    if (empty($headers)) {
        $headers = array('Content-type: text/json');
    } elseif (!is_array($headers)) {
        parse_str($headers,$headers);
    }
    // setting the curl parameters.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // turning off the server and peer verification(TrustManager Concept).
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // setting the POST FIELD to curl
    switch ($method){
        case "GET" : curl_setopt($ch, CURLOPT_HTTPGET, 1);break;
        case "POST": curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestString);break;
        case "PUT" : curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestString);break;
        case "DELETE":  curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestString);break;
    }
    // getting response from server
    $response = curl_exec($ch);

    //close the connection
    curl_close($ch);

    //return the response
    if (stristr($response, 'HTTP 404') || $response == '') {
        return array('Error' => '请求错误','data'=>$response);
    }
    return $response;
}

/**
 * [object_to_array 对象转为数组]
 *
 * @Author           :10132143203@qq.com
 * @对象转为数组
 *
 * @param  object  $array  [需要转换的对象]
 *
 * @return                               array         [description]
 */
function object_to_array($array)
{
    if ( is_object($array) ) $array = (array)$array;
    if ( is_array($array) ) {
        foreach ($array as $key => $value) $array[$key] = object_to_array($value);
    }
    return $array;
}


/**
 * @param $lat1
 * @param $lng1
 * @param $lat2
 * @param $lng2
 *
 * @return int
 *
 * 经纬度计算两点之间的距离
 */
function getDistance($lat1, $lng1, $lat2, $lng2, $radius = 6378.137)
{
    $rad = floatval(M_PI / 180.0);

    $lat1 = floatval($lat1) * $rad;
    $lng1 = floatval($lng1) * $rad;
    $lat2 = floatval($lat2) * $rad;
    $lng2 = floatval($lng2) * $rad;

    $theta = $lng2 - $lng1;

    $dist = acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($theta));

    if ( $dist < 0 ) {
        $dist += M_PI;
    }
    return $dist = $dist * $radius;
}

if ( !function_exists('del_dir_files') ) {
    /**
     * 删除文件夹与下方的所有文件
     *
     * @param       $dirName     文件夹名称
     * @param  int  $delete_dir  是否删除文件夹【1.删除；0.不删除】
     */
    function del_dir_files($dirName, $delete_dir = 1)
    {
        if ( $handle = @opendir($dirName) ) {
            while ( false !== ($item = @readdir($handle)) ) {
                if ( $item != '.' && $item != '..' ) {
                    if ( is_dir($dirName . '/' . $item) ) del_dir_files($dirName . '/' . $item); else @unlink($dirName . '/' . $item);
                }
            }
            @closedir($handle);
        }
        if ( $delete_dir == 1 ) @rmdir($dirName);
    }
}

if ( !function_exists('write_lock_file') ) {
    /**
     * 写入锁文件
     *
     * @param $path
     */
    function write_lock_file($path, $content = '')
    {
        $lock_file = fopen($path . '/lock', 'w+');//创建 锁文件
        fwrite($lock_file, empty($content) ? date('Y-m-d H:i:s') : $content);//写入
    }
}

function get_url() : string
{
    $scheme = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
    $url = $scheme . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '/' . $_SERVER['REQUEST_URI'];
    return $url;
}

function formatting_timestamp($the_time){
    $now_time = time();
    $show_time = strtotime($the_time);
    $a = $now_time - $show_time;
    if($a < 0){
        return $the_time;
    }else{
        if($a < 60){
            return $a.'秒前';
        }else{
            if($a < 3600){
                return floor($a/60).'分鐘前';
            }else{
                if($a < 86400){
                    return floor($a/3600).'小時前';
                }else{
                    if($a < 259200){//3天內
                        return floor($a/86400).'天前';
                    }else{
                        return date('Y-m-d',$show_time);
                    }
                }
            }
        }
    }
}

function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}

function success($data = [] , $msg='success')
{
    return response()->json([
        'code' => 200,
        'msg' => $msg,
        'data' => $data,
    ]);
}
