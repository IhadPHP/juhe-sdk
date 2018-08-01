<?php
/**
 * 聚合sdk测试
 */
include_once './../src/core.php';
include_once './../src/common.php';

use syrecords\juhe\core;

/**
 * QQ号码测吉凶
 * link：https://www.juhe.cn/docs/api/id/166
 */
$appKey = ''; // $appkey 在个人中心->我的数据,接口名称上方查看
$sdk = new core($appKey);
$url = 'http://japi.juhe.cn/qqevaluate/qq'; //号码测吉凶API URL
$data = $sdk->getQqForecast($url,'85464277');
var_dump($data);

/**
 * 获取天气预报
 * link：https://www.juhe.cn/docs/api/id/39
 */
$appKey = ''; // $appkey 在个人中心->我的数据,接口名称上方查看
$sdk = new core($appKey);
$cityUrl = 'http://v.juhe.cn/weather/citys'; //城市列表API URL
$data = $sdk->getWeatherCitys($cityUrl); // 获取支持的城市
var_dump($data);

$cityNameUrl = 'http://v.juhe.cn/weather/index'; //根据城市名/id查询天气API URL
$city = '西安';
$data = $sdk->getWeatherByName($cityNameUrl,$city,2); // 获取城市天气
echo '<pre>';
var_dump($data);