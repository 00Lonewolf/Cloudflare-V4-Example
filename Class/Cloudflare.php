<?php
/*
	*配置文件各参数
	*$url CF的API接口网址
	*$method 传值类型
	*$data 传入的参数
	*$apikey CF的API秘钥
	*$email CF邮箱账号
	*$cfapi 包含global_api_key、email、zone
	*联系方式 QQ1342193014
	*Time 2021.05.24 21:45:00
*/
class post
{
    public static function postgo($url = "",$method = "",$data = array(),$apikey,$email) {
        $headers = array(
            'Content-Type: ' . "application/json" ,
            "X-Auth-Key: " . "$apikey" ,
            "X-Auth-Email: " . "$email"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360000);
        //设置超时
        if (0 === strpos(strtolower($url), 'https')) {
            //https请求
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            //对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            //从证书中检查SSL加密算法是否存在
        }
        curl_setopt($ch, CURLOPT_POST, false);
        if ($method == "DELETE") {
            curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }
        if ($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        if ($method == "PATCH") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        //curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $resp = curl_exec ($ch);
        curl_close ($ch);
        return $resp;
    }
}
    $cfapi = array(
        array('global_api_key' => 'BBBBBBBB052f67113c5352596000000'),//Cloudflare-API
        array('email' => 'xiaobao@google.com'),//邮箱
		array('zone' => 'BBBBBBBB052f67113c5352596000000'),//区域 ID
    );

?>
