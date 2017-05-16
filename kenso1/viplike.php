<?php
set_time_limit(0);
include '../system/config.php';
$like = array(0, 200, 500, 1000, 2000, 5000);
$req = mysql_query("SELECT `idfb`, `goi` FROM `VIP` ORDER BY RAND() LIMIT 0,5");
while($res = mysql_fetch_assoc($req)){
$idfb = $res['idfb'];
$reqt = mysql_query("SELECT `token` FROM `token` ORDER BY RAND() LIMIT 0,69");
while($rest = mysql_fetch_assoc($reqt)){
$token = $rest['token'];
$stat = json_decode(auto('https://graph.facebook.com/'.$idfb.'/feed?fields=id&access_token='.$token.'&limit=1'),true);
		$countlike = $stat[data][0][likes][count];
		if($countlike <= $like[$res['goi']]){
			for($i=1;$i<=count($stat['data']);$i++){
				auto('https://graph.facebook.com/'.$stat['data'][$i-1]['id'].'/likes?access_token='.$token.'&method=post');
			}
		}
}
}
function auto($url) {
   $ch = curl_init();
   curl_setopt_array($ch, array(
      CURLOPT_CONNECTTIMEOUT => 5,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_URL            => $url,
      )
   );
   $result = curl_exec($ch);
   curl_close($ch);
   return $result;
}