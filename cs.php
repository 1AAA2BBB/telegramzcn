<?php

function get_client_ip() {
if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
$ip = getenv("HTTP_CLIENT_IP");
else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"),
"unknown"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
$ip = getenv("REMOTE_ADDR");
else if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']
&& strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
$ip = $_SERVER['REMOTE_ADDR'];
else
$ip = "unknown";
return ($ip);
}
$verification=array('北京市','成都市','上海市','深圳市','杭州市','宁波市','温州市','嘉兴市','湖州市','绍兴市','金华市','衢州市','舟山市','台州市','丽水市','南京市','无锡市','徐州市','常州市','苏州市','南通市','连云港市','淮安市','盐城市','扬州市','镇江市','泰州市','宿迁市','乌鲁木齐市','克拉玛依市','吐鲁番市','哈密市','银川市','石嘴山市','吴忠市','固原市','中卫市','呼和浩特市','包头市','乌海市','赤峰市','通辽市','鄂尔多斯市','呼伦贝尔市','巴彦淖尔市','乌兰察布市','兴安盟','锡林郭勒盟','阿拉善盟','郑州市','武汉市'); //修改所在市
$ip = get_client_ip();
//$antecedents = $_SERVER['HTTP_REFERER'];//放行搜索引擎
$result = file_get_contents("http://whois.pconline.com.cn/ipJson.jsp?ip=".$ip."&json=true");
$result = iconv("gb2312", "utf-8//IGNORE",$result);
$address = json_decode($result,true);
for($i=0;$i<count($verification);$i++){
if($address['city'] == $verification[$i] && strpos($antecedents, 'baidu') === false && strpos($antecedents, 'google') === false){
header("HTTP/1.1 500 Not Found");
header("Status: 500 Not Found");  
exit;
}
}

/**
 * @copyright (C)2016-2099 Hnaoyun Inc.
 * @author XingMeng
 * @email hnxsh@foxmail.com
 * @date 2016年11月5日
 *  用户前端入口文件
 */
// 定义为入口文件
define('IS_INDEX', true);

// 入口文件地址绑定
define('URL_BIND', 'home');

// PHP版本检测
if (PHP_VERSION < '5.4') {
    header('Content-Type:text/html; charset=utf-8');
    exit('您服务器PHP的版本太低，程序要求PHP版本不小于5.4');
}

// 引用内核启动文件
require dirname(__FILE__) . '/core/start.php';
