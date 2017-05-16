<?php
set_time_limit(0);
include '../system/config.php';
$req = mysql_query("SELECT `reaction`, `token` FROM `account` WHERE `token`!='' AND `reaction`!='' ORDER BY RAND() LIMIT 0,69");
while($res = mysql_fetch_assoc($req)){
$stt = rand(10, 15);
$aron = json_decode(auto('https://graph.facebook.com/me/home?fields=id,message,created_time,from,comments,type&access_token='.$res['token'].'&offset=0&limit='.$stt),true);
$max = count($aron['data'])+1;
for($i = 1; $i < $max; ++$i){
echo auto('https://graph.facebook.com/'.$aron['data'][$i-1]['id'].'/reactions?type='.$res['camxuc'].'&method=post&access_token='.$res['token']);
}
}
function auto($url){
$data = curl_init();
curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($data, CURLOPT_URL, $url);
$hasil = curl_exec($data);
curl_close($data);
return $hasil;
}