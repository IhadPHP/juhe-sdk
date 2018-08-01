<?php
/**
 * 聚合sdk测试
 */
include_once './../src/core.php';

use syrecords\juhe\core;

$appKey = ''; // $appkey 在个人中心->我的数据,接口名称上方查看

$url = ''; //API URL

$params = array(
    'key' => $appKey,//申请的appKey
//    ... 具体对应的参数
);

$data = core::juHeParams($params,$url);

echo '<pre>';
var_dump($data);