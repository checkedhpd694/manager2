<?php
session_start();
if(!$_SESSION['idfb'] && !$_SESSION['ten'] && !$_SESSION['token']){
header('Location: index.php?i=8');
}
include './system/head.php';
include './system/config.php';
if(isset($_GET['i'])){
switch($_GET['i']) {
case 1:
$errorMsg = "Subscribers or Likers Failed, Time Limit Reached, Please Wait 10 mins Later..";
break;
case 2:
$errorMsg = "Follower Failed Robot verification failed";
break;
case 3:
$errorMsg = "Login Success";
break;
case 4:
$errorMsg = "Successful Subscribers Sent";
break;
case 4:
$errorMsg = "Successful Likers Sent";
break;
default:
$errorMsg = "DXB Was Here :)";
break;
}
}
if($_SESSION['idfb'] && $_SESSION['ten'] && $_SESSION['token']){
$live = json_decode(auto('https://graph.facebook.com/me?access_token='.$_SESSION['token']),true);
if(!$live['id']){
session_destroy();
header('Location: index.php?i=1');
}
?>
<div class="col-lg-8 col-lg-offset-2">
<?php
if($errorMsg){
?>
<div class="thongbao"><center><?= $errorMsg ?></center></div>
<?php
}
?>
<div class="panel-group">
  <div class="panel panel-primary">
    <div class="panel-heading">Select our service
    </div>
    <div class="panel-body">
      <center>
        <h4>Welcome 
          <a href="//fb.com/<?php echo $_SESSION['idfb']; ?>" target="_blank">
            <?php echo $_SESSION['ten']; ?>
          </a> to <?= $name ?>
        </h4>
        <h5 class="light"> We are working on updates.
          <br> 
          <font color="green">Do not forget to read the rules.
          </font>
        </h5>
        <a href="follow.php" class="btn btn-danger">
          <i class="fa fa-rss">
          </i> Auto Follow
        </a>
        <a href="autorequest.php" class="btn btn-danger">
          <i class="fa fa-user-plus"></i> Auto Request
        </a>
        <a href="out.php" class="btn btn-danger">
          <i class="fa fa-sign-out">
          </i> Logout
        </a>
        <br>
        <br>
      </center>
    </div>
  </div>
</div>
</div>
<?php
}
function auto($url){
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
$ch = curl_exec($curl);
curl_close($curl);
return $ch;
}
include './system/foot.php';