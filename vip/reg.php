<?php
include '../system/config.php';
include '../system/head.php';
$rand = rand(100000,999999);
?>
<div class="col-md-4 col-lg-offset-4">
        <?php
if(isset($_POST['submit'])){
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$captcha = trim($_POST['captcha']);
$captcha_number = trim($_POST['captcha_number']);
mysql_query("CREATE TABLE IF NOT EXISTS `ACCOUNT` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(32) NOT NULL,
`password` varchar(32) NOT NULL,
`vnd` int(10) NOT NULL,
`limit` int(10) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
");
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `ACCOUNT` WHERE `username`='$username'"), 0);
if(!$username || !$password || $captcha != $captcha_number){
echo '<div class="thongbao">Please fill form fully</div>';
}else if($check > 0){
echo '<div class="thongbao">Username is exist</div>';
}else{
mysql_query("INSERT INTO `ACCOUNT` SET
`username`='$username',
`password`='$password',
`vnd`=0,
`limit`=1
");
echo '<div class="thongbao">Successful</div>';
echo '<meta http-equiv="refresh" content="0;url=index.php">';
}
}
?>
  <div class="panel-group">
    <div class="panel panel-primary">
      <div class="panel-heading">Sign Up
      </div>
      <div class="panel-body">
        <form action="" method="POST">
          <div class="form-group input-group">
            <span class="input-group-addon">
              <i class="fa fa-user">
              </i> 
            </span>
            <input class="form-control" placeholder="Username" name="username" type="text" required>
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon">
              <i class="fa fa-lock">
              </i>
            </span>
            <input class="form-control" placeholder="Password" name="password" type="password" required>
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon"><input type="text" id="captcha_number" name="captcha_number" value="<?= $rand ?>" readonly=""></span>
            <input type="number" class="form-control" name="captcha" placeholder="Captcha" required>                                        
          </div>
          <button type="submit" name="submit" class="btn btn-lg btn-danger btn-block">
            <i class="fa fa-sign-in fa-fw">
            </i> Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<style>
#captcha_number{
    width:66px;
    height:20px;
    text-align:center;
    background:#333;color:#fff;
    font-weight:bold;
}
</style>
<?php
include '../system/foot.php';