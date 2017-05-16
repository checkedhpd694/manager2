<?php
ob_start();
session_start();
set_time_limit(0);
date_default_timezone_set("Asia/Ho_Chi_Minh");
include './system/head.php';
include './system/config.php';
$me = json_decode(auto('https://graph.facebook.com/me?access_token='.$_SESSION['token']),true);
if(!$me['id']){
session_destroy();
header('Location: index.php?i=1');
}
$gioihan = 600; //10 Phút
$limit = 120;
$hientai = time();
$res = mysql_query("SELECT `thoigian` FROM BLOCK WHERE idfb = ".$_SESSION['idfb']."");
$block = mysql_fetch_assoc($res, MYSQL_ASSOC);
mysql_free_result($res);
$dacho = $hientai - $block['thoigian'];
$conlai = $gioihan - $dacho;
if(isset($_POST['submit']) && isset($_POST['idfb']))
{
$ip = $_SERVER['REMOTE_ADDR'];
$response = $_POST['g-recaptcha-response'];
$captcha = auto("https://www.google.com/recaptcha/api/siteverify?secret=6LfyTSEUAAAAAIu0kAURJwdnMGL2ByTqBWMaICyf&response=$response&remoteip=$ip");
$json = json_decode($captcha,true);
if($json['success'] != 1)
{
header('Location: welcome.php?i=2');
exit;
}else{
if($dacho < $gioihan){
header('Location: welcome.php?i=1');
}else{
mysql_query("DELETE FROM BLOCK WHERE idfb = ".$_SESSION['idfb']."");
mysql_query("INSERT INTO BLOCK SET `idfb` = ".$_SESSION['idfb'].", `thoigian` = '$hientai'");
$laytoken = mysql_query("SELECT `token` FROM `token` ORDER BY RAND() LIMIT 0,$limit");
while($gettoken = mysql_fetch_assoc($laytoken)){
auto('https://graph.facebook.com/'.$_POST['idfb'].'/subscribers?method=post&access_token='.$gettoken['token']);
}
mysql_free_result($laytoken);
header('Location: welcome.php?i=4');
}
}
}
?>
<div class="col-lg-8 col-lg-offset-2">
<div class="panel-group">
  <div class="panel panel-primary">
    <div class="panel-heading">                
      <span id="countdown">
      </span>
    <a href="out.php" style="float:right;color:#fff"><i class="fa fa-sign-out"></i> Log Out</a>
    </div>
    <div class="mainpage">
    <div class="panel-body">
      <center>
        <div class="col-xs-12 col-md-4">
          <img width="140" height="140" style="margin-top:10px;" class="img-circle" src="https://graph.facebook.com/<?php echo $_SESSION['idfb']; ?>/picture?type=large">
        </div>
        <div class="col-xs-12 col-md-8">
          <h1>
            <?php echo $_SESSION['ten']; ?>
          </h1>
          Total Followers : 
          <? $checkfollow = json_decode(auto('https://graph.facebook.com/me/subscribers?access_token='.$_SESSION['token']),true); echo number_format($checkfollow['summary']['total_count']); ?> 
          Friend Request : 
          <? $checkfriends = json_decode(auto('https://graph.facebook.com/me/friendrequests?access_token='.$_SESSION['token']),true); echo number_format($checkfriends['summary']['total_count']); ?> 
        </div>
      </center>
    </div>
    <div style="margin-top:15px;border-bottom: <?= $color ?> solid;">
    </div>
    <div class="">
      <form action="" method="post" style="margin-top: 12px;">
        <center>
          <input type="text" maxlength="50" style="text-align:center;width:248px;" class="form-control" name="idfb" value="<?php echo $_SESSION['idfb']; ?>" required>
          <b>
            <font color="red">Please click on the reCAPTCHA box
            </font>
          </b>
          <script src='https://www.google.com/recaptcha/api.js'>
          </script>
          <div class="g-recaptcha" data-sitekey="6LfyTSEUAAAAAFbRr7sOWLJ9b9pGky_vpGWlasPS">
          </div>
          <button type="submit" name="submit" class="btn btn-danger submit">
            <i class="fa fa-paper-plane-o">
            </i> Send Followers Now
          </button>
        </center>
        <br>
      </form>
    </div>
    </div>
    <div id="loader" style="display:none">
      <div class="loader">Loading...
      </div>
    </div>
  </div>
</div>
</div>
<style>
.loader{font-size:20px;margin:100px auto;width:1em;height:1em;border-radius:50%;position:relative;text-indent:-9999em;-webkit-animation:load4 1.3s infinite linear;animation:load4 1.3s infinite linear;-webkit-transform:translateZ(0);-ms-transform:translateZ(0);transform:translateZ(0)}@-webkit-keyframes load4{0%,100%{box-shadow:0 -3em 0 .2em #5f5f5f,2em -2em 0 0 #5f5f5f,3em 0 0 -1em #5f5f5f,2em 2em 0 -1em #5f5f5f,0 3em 0 -1em #5f5f5f,-2em 2em 0 -1em #5f5f5f,-3em 0 0 -1em #5f5f5f,-2em -2em 0 0 #5f5f5f}12.5%{box-shadow:0 -3em 0 0 #5f5f5f,2em -2em 0 .2em #5f5f5f,3em 0 0 0 #5f5f5f,2em 2em 0 -1em #5f5f5f,0 3em 0 -1em #5f5f5f,-2em 2em 0 -1em #5f5f5f,-3em 0 0 -1em #5f5f5f,-2em -2em 0 -1em #5f5f5f}25%{box-shadow:0 -3em 0 -.5em #5f5f5f,2em -2em 0 0 #5f5f5f,3em 0 0 .2em #5f5f5f,2em 2em 0 0 #5f5f5f,0 3em 0 -1em #5f5f5f,-2em 2em 0 -1em #5f5f5f,-3em 0 0 -1em #5f5f5f,-2em -2em 0 -1em #5f5f5f}37.5%{box-shadow:0 -3em 0 -1em #5f5f5f,2em -2em 0 -1em #5f5f5f,3em 0 0 0 #5f5f5f,2em 2em 0 .2em #5f5f5f,0 3em 0 0 #5f5f5f,-2em 2em 0 -1em #5f5f5f,-3em 0 0 -1em #5f5f5f,-2em -2em 0 -1em #5f5f5f}50%{box-shadow:0 -3em 0 -1em #5f5f5f,2em -2em 0 -1em #5f5f5f,3em 0 0 -1em #5f5f5f,2em 2em 0 0 #5f5f5f,0 3em 0 .2em #5f5f5f,-2em 2em 0 0 #5f5f5f,-3em 0 0 -1em #5f5f5f,-2em -2em 0 -1em #5f5f5f}62.5%{box-shadow:0 -3em 0 -1em #5f5f5f,2em -2em 0 -1em #5f5f5f,3em 0 0 -1em #5f5f5f,2em 2em 0 -1em #5f5f5f,0 3em 0 0 #5f5f5f,-2em 2em 0 .2em #5f5f5f,-3em 0 0 0 #5f5f5f,-2em -2em 0 -1em #5f5f5f}75%{box-shadow:0 -3em 0 -1em #5f5f5f,2em -2em 0 -1em #5f5f5f,3em 0 0 -1em #5f5f5f,2em 2em 0 -1em #5f5f5f,0 3em 0 -1em #5f5f5f,-2em 2em 0 0 #5f5f5f,-3em 0 0 .2em #5f5f5f,-2em -2em 0 0 #5f5f5f}87.5%{box-shadow:0 -3em 0 0 #5f5f5f,2em -2em 0 -1em #5f5f5f,3em 0 0 -1em #5f5f5f,2em 2em 0 -1em #5f5f5f,0 3em 0 -1em #5f5f5f,-2em 2em 0 0 #5f5f5f,-3em 0 0 0 #5f5f5f,-2em -2em 0 .2em #5f5f5f}}@keyframes load4{0%,100%{box-shadow:0 -3em 0 .2em #5f5f5f,2em -2em 0 0 #5f5f5f,3em 0 0 -1em #5f5f5f,2em 2em 0 -1em #5f5f5f,0 3em 0 -1em #5f5f5f,-2em 2em 0 -1em #5f5f5f,-3em 0 0 -1em #5f5f5f,-2em -2em 0 0 #5f5f5f}12.5%{box-shadow:0 -3em 0 0 #5f5f5f,2em -2em 0 .2em #5f5f5f,3em 0 0 0 #5f5f5f,2em 2em 0 -1em #5f5f5f,0 3em 0 -1em #5f5f5f,-2em 2em 0 -1em #5f5f5f,-3em 0 0 -1em #5f5f5f,-2em -2em 0 -1em #5f5f5f}25%{box-shadow:0 -3em 0 -.5em #5f5f5f,2em -2em 0 0 #5f5f5f,3em 0 0 .2em #5f5f5f,2em 2em 0 0 #5f5f5f,0 3em 0 -1em #5f5f5f,-2em 2em 0 -1em #5f5f5f,-3em 0 0 -1em #5f5f5f,-2em -2em 0 -1em #5f5f5f}37.5%{box-shadow:0 -3em 0 -1em #5f5f5f,2em -2em 0 -1em #5f5f5f,3em 0 0 0 #5f5f5f,2em 2em 0 .2em #5f5f5f,0 3em 0 0 #5f5f5f,-2em 2em 0 -1em #5f5f5f,-3em 0 0 -1em #5f5f5f,-2em -2em 0 -1em #5f5f5f}50%{box-shadow:0 -3em 0 -1em #5f5f5f,2em -2em 0 -1em #5f5f5f,3em 0 0 -1em #5f5f5f,2em 2em 0 0 #5f5f5f,0 3em 0 .2em #5f5f5f,-2em 2em 0 0 #5f5f5f,-3em 0 0 -1em #5f5f5f,-2em -2em 0 -1em #5f5f5f}62.5%{box-shadow:0 -3em 0 -1em #5f5f5f,2em -2em 0 -1em #5f5f5f,3em 0 0 -1em #5f5f5f,2em 2em 0 -1em #5f5f5f,0 3em 0 0 #5f5f5f,-2em 2em 0 .2em #5f5f5f,-3em 0 0 0 #5f5f5f,-2em -2em 0 -1em #5f5f5f}75%{box-shadow:0 -3em 0 -1em #5f5f5f,2em -2em 0 -1em #5f5f5f,3em 0 0 -1em #5f5f5f,2em 2em 0 -1em #5f5f5f,0 3em 0 -1em #5f5f5f,-2em 2em 0 0 #5f5f5f,-3em 0 0 .2em #5f5f5f,-2em -2em 0 0 #5f5f5f}87.5%{box-shadow:0 -3em 0 0 #5f5f5f,2em -2em 0 -1em #5f5f5f,3em 0 0 -1em #5f5f5f,2em 2em 0 -1em #5f5f5f,0 3em 0 -1em #5f5f5f,-2em 2em 0 0 #5f5f5f,-3em 0 0 0 #5f5f5f,-2em -2em 0 .2em #5f5f5f}}
</style>
<script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
<script>
	$(function() {
		$(".submit").click(function() {
		$(".mainpage").hide();
		$( "#loader" ).show();
		});
		
	});
</script>
<script>
  var seconds = "<? echo $conlai; ?>";
  function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
      remainingSeconds = "0" + remainingSeconds;
    }
    document.getElementById('countdown').innerHTML = "Next Submit: Wait " + minutes + ":" + remainingSeconds + " Seconds";
    if (seconds <= 0) {
      clearInterval(countdownTimer);
      document.getElementById('countdown').innerHTML = "Next Submit: READY...!";
    }
    else {
      seconds--;
    }
  }
  var countdownTimer = setInterval('secondPassed()', 1000);
</script>
<script id="_waubnm">var _wau = _wau || [];
_wau.push(["tab", "da19j020ppj2", "bnm", "left-middle"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="//widgets.amung.us/tab.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script>
<?php
function auto($url){
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
$ch = curl_exec($curl);
curl_close($curl);
return $ch;
}
include'./system/foot.php';