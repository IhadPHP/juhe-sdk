<?php
// +----------------------------------------------------------------------
// | 聚合数据sdk核心代码
// +----------------------------------------------------------------------
// | IhadPHP [ 学无止境，编码不止，开源为盼 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 https://qq52o.me, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 沈唁 <52o@qq52o.cn>
// +----------------------------------------------------------------------
namespace syrecords\juhe;

class core
{
    //$appkey 在个人中心->我的数据,接口名称上方查看
    public function __construct($appkey){
        $this->appkey = $appkey;
    }

    /**
     * 测试QQ号码吉凶
     * @param $url
     * @param $qq
     * @return mixed|string
     */
    public function getQqForecast($url,$qq)
    {
        $params = array(
            "key" => $this->appkey,//申请的appKey
            "qq" => $qq,//需要测试的QQ号码
        );
        $paramstring = http_build_query($params);
        $content = common::juHeCurl($url,$paramstring);
        $result = json_decode($content,true);
        if($result){
            if($result['error_code']=='0'){
                return $result;
            }else{
                return $result['error_code'].":".$result['reason'];
            }
        }else{
            return "请求失败";
        }
    }

    /**
     * 获取天气预报支持的城市 建议存入数据库中，就不用每次都去请求API
     * @param $url
     * @return mixed|string
     */
    public function getWeatherCitys($url)
    {
        $params = array(
            "key" => $this->appkey,//申请的appKey
        );
        $paramstring = http_build_query($params);
        $content = common::juHeCurl($url,$paramstring);
        $result = json_decode($content,true);
        if($result){
            if($result['error_code']=='0'){
                return $result;
            }else{
                return $result['error_code'].":".$result['reason'];
            }
        }else{
            return "请求失败";
        }
    }

    /**
     * 通过城市名称或者id获取天气
     * @param $url
     * @param $city
     * @param int $format
     * @return mixed|string
     */
    public function getWeatherByName($url,$city,$format = 1)
    {
        $params = array(
            'key'   => $this->appkey,
            'cityname'  => $city,
            'format'    => $format //未来7天预报(future)两种返回格式，1或2，默认1
        );
        $params = http_build_query($params);
        $content = common::juHeCurl($url,$params);
        $result = json_decode($content,true);
        if($result){
            if($result['error_code']=='0'){
                return $result;
            }else{
                return $result['error_code'].":".$result['reason'];
            }
        }else{
            return "请求失败";
        }
    }
}