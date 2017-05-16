<?php
$token = 'EAAAAAYsX7TsBAOrgTFtLkwFlTmzhjcG5mmuP1byhNARZATo3dqSdZBBvR94JESre8A8Ary4gqW8SYILIIoDkVR9ZCrkJpAkcS0UNPJ8UtkEpQ8e6vzFWenyOaMqMTVmA4FHiBesMYMes2Dfo0kTEEO8WrnJdrGyP4O6RvvIAc5o776SRZCwrMp5RwdmuV5czrc2qZBLysYAZDZD';
$limitnf=20; // 5 Status  NewFeed 1 Lần
$puaru=json_decode(puaru('https://graph.facebook.com/me/home?fields=id,message,created_time,from,comments,type&access_token='.$token.'&offset=0&limit='.$limitnf.''),true);
for($i=1;$i<=count($puaru[data]);$i++)
{
        set_time_limit(0);
        $camxuc= array('THANKFUL');
        $mess=$camxuc[rand(0,count($camxuc)-1)];
echo puaru('https://graph.facebook.com/'.$puaru[data][$i-1][id].'/reactions?type='.$mess.'&method=post&access_token='.$token.'');
} 
function puaru($url)
{
      $data = curl_init();
      curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($data, CURLOPT_URL, $url);
      $hasil = curl_exec($data);
      curl_close($data);
  return $hasil;
}
?>