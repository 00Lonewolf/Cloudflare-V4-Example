<?php
/* 
 *Cloudflare Source Modular
 *Cloudflare开发者模式设置
 */
require("Class/Cloudflare.php");

$choice = $_GET["name"];
if($choice=='1'){
	$data = '{"value":"on"}';
}elseif ($choice=='2'){
	$data = '{"value":"off"}';
}
$data = json_decode($data,true);
$response = post::postgo('https://api.cloudflare.com/client/v4/zones/'.$cfapi['2']['zone'].'/settings/development_mode','PATCH',$data,$cfapi['0']['global_api_key'],$cfapi['1']['email']);
var_dump (json_decode($response,true));
?>
