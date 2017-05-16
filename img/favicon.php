<?php

//// $host = "localhost";
$username = "vipfb_auto";
$password = "apPG`Ch]cM'N6ha22c[6~T.y";
$dbname = "vipfb_auto";
$connection = mysql_connect($host,$username,$password);
if (!$connection)
  {
  die('Could not connect: ' . mysql_error());

  }
mysql_select_db($dbname) or die(mysql_error());
mysql_query("SET NAMES utf8"); ////

////////--END--////////

$tabletoken = 'token'; // Tren Table chứa token
$result = mysql_query("SELECT * FROM $tabletoken");
while($row = mysql_fetch_array($result)){
echo $row['token'].'<br/>'; // Tên cột chứa Mã Token của Table
}
?>