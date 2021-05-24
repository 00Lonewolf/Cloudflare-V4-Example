<?php
/* 
 *Cloudflare Firewall Modular
 *Cloudflare安全级别
 *off 完全关闭
 *essentially_off 基本关闭.
 *low 低
 *medium 中
 *high 高
 *under_attack 受到攻击
 */
require("Class/Cloudflare.php");
$choice = $_GET["name"];
if($choice=='1'){
	$data = '{"value":"essentially_off"}';
}elseif ($choice=='2'){
	$data = '{"value":"medium"}';
}elseif ($choice=='3'){
	$data = '{"value":"under_attack"}';
}
$data = json_decode($data,true);
$response = post::postgo('https://api.cloudflare.com/client/v4/zones/'.$cfapi['2']['zone'].'/settings/security_level','PATCH',$data,$cfapi['0']['global_api_key'],$cfapi['1']['email']);
echo (json_decode($response,true)['result']['value']);
?>