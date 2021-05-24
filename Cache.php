<?php
/* 
 *Cloudflare Cache Modular
 *Cloudflare清除所有缓存
 */
require("Class/Cloudflare.php");

$data = '{"purge_everything":true}';
$data = json_decode($data,true);
$response = post::postgo('https://api.cloudflare.com/client/v4/zones/'.$cfapi['2']['zone'].'/purge_cache','POST',$data,$cfapi['0']['global_api_key'],$cfapi['1']['email']);
echo (json_decode($response,true)["success"]);
?>