<?php
set_time_limit(0);
include '../system/config.php';
$req = mysql_query("SELECT `token` FROM `token` ORDER BY RAND() LIMIT 0,6969");
while($res = mysql_fetch_assoc($req)){
$token = $res['token'];
$me = me($token);
if(!$me['id']){
mysql_query("DELETE FROM `token` WHERE `token`='$token'");
}
}
echo 'Done';
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