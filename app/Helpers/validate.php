<?php
if ( !function_exists('validStringJson') ) {
    /**
     * 判断字符串是否为 Json 格式
     *
     * @param  string  $data   Json 字符串
     * @param  bool    $assoc  是否返回关联数组。默认返回对象
     *
     * @return array|bool|object 成功返回转换后的对象或数组，失败返回 false
     */
    function validStringJson($data = '', $assoc = false)
    {
        if ( PHP_VERSION > 5.3 ) {
            json_decode($data);
            return (json_last_error() == JSON_ERROR_NONE);
        } else {
            $data = json_decode($data, $assoc);
            if ( ($data && is_object($data)) || (is_array($data) && !empty($data)) ) {
                return $data;
            }
            return false;
        }
    }
}

/**
 *
 * @param              [type]  $str [description]
 *
 * @return             boolean      [description]
 * @author             : 10132143203@qq.com
 * @检测是否为base64位编码
 */
function validBase64($str)
{
    //这里多了个纯字母和纯数字的正则判断
    if ( @preg_match('/^[0-9]*$/', $str) || @preg_match('/^[a-zA-Z]*$/', $str) ) return false; elseif ( is_utf8(base64_decode($str)) && base64_decode($str) != '' ) return true;
    return false;
}

/**
 * 检测身份证号码
 *
 * @param  string  $id
 *
 * @return bool
 */
function validIdCard(string $id) : bool
{
    $id = strtoupper($id);
    $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
    $arr_split = [];
    if ( !preg_match($regx, $id) ) return false;
    if ( 15 == strlen($id) ) { //检查15位
        $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";
        @preg_match($regx, $id, $arr_split);
        //检查生日日期是否正确
        $dtm_birth = "19" . $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
        if ( !strtotime($dtm_birth) ) return false; else return true;
    } else {      //检查18位
        $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
        @preg_match($regx, $id, $arr_split);
        $dtm_birth = $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
        if ( !strtotime($dtm_birth) ) return false;//检查生日日期是否正确
        else {
            //检验18位身份证的校验码是否正确。
            //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
            $arr_int = [
                7,
                9,
                10,
                5,
                8,
                4,
                2,
                1,
                6,
                3,
                7,
                9,
                10,
                5,
                8,
                4,
                2,
            ];
            $arr_ch = [
                '1',
                '0',
                'X',
                '9',
                '8',
                '7',
                '6',
                '5',
                '4',
                '3',
                '2',
            ];
            $sign = 0;
            for ($i = 0; $i < 17; $i++) {
                $b = (int)$id{$i};
                $w = $arr_int[$i];
                $sign += $b * $w;
            }
            $n = $sign % 11;
            $val_num = $arr_ch[$n];
            if ( $val_num != substr($id, 17, 1) ) return false; else return true;//phpfensi.com
        }
    }
}

//是否为手机号码
if ( !function_exists('validMobile') ) {
    function validMobile(string $text)
    {
        $search = '/^0?1[3|4|5|6|7|8][0-9]\d{8}$/';
        if ( preg_match($search, $text) ) return true; else return false;
    }
}

/**
 *
 * @param  string  $date  [description]
 *
 * @return             boolean       [description]
 * @author           :10132143203@qq.com
 * @是否为日期格式
 */
function validDate(string $date) : bool
{
    $ret = strtotime($date);
    return $ret !== false && $ret != -1;

    // if (date('Y-m-d H:i:s', strtotime($date)) === $date) return true;
    // else return false;
}

/**
 *
 * @param  string  $email  [description]
 *
 * @return             boolean        [description]
 * @author           : 10132143203@qq.com
 * @检测邮箱格式
 */
function validEmail(string $email) : bool
{
    // '/^[a-z0-9]+([._-][a-z0-9]+)*@([0-9a-z]+\.[a-z]{2,14}(\.[a-z]{2})?)$/i';
    $checkmail = "/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";//定义正则表达式
    if ( preg_match($checkmail, $email) ) return true; else return false;
}

/**
 *
 * @param  string  $_url  [description]
 *
 * @return bool
 * @author           :10132143203@qq.com
 * @检测URL地址格式
 */
function validUrl(string $_url) : bool
{
    $str = "/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/";
    if ( !preg_match($str, $_url) ) return false; else return true;
}

if ( !function_exists('validDirExits') ) {
    /**
     * 检测目录是否存在，不存在则创建目录
     *
     * @param  string  $dir_path
     */
    function validDirExits(string $dir_path) : void
    {
        if ( !is_dir($dir_path) ) @mkdir($dir_path, 0755, true);
    }
}

