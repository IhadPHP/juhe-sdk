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
    /**
     * 处理参数+请求
     * @param array $params 参数数组
     * @param $url 请求的curl
     * @return mixed|string
     */
    public static function juHeParams($params = array(),$url)
    {
        $paramstring = http_build_query($params);
        $content = self::juHeCurl($url,$paramstring);
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
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public static function juHeCurl($url,$params=false,$ispost=0)
    {
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }
}