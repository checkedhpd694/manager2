							<meta charset="utf-8">
<title>Hacker</title>
<?php
session_start();
error_reporting(0);
include '../config.php';

$result = mysql_query("SELECT * FROM token");
if($result){
while($row = mysql_fetch_array($result))
  {
$token = $row[token];
echo"$token <br>";
}
}
?>