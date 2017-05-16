<?php
session_start();
include '../system/config.php';
include '../system/head.php';
if(!$_SESSION['user']){
$rand = rand(100000,999999);
?>
<div class="col-lg-4 col-lg-offset-4">
  <?php
if(isset($_POST['submit'])){
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$captcha = trim($_POST['captcha']);
$captcha_number = trim($_POST['captcha_number']);
if($username && $password && $captcha){
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `ACCOUNT` WHERE `username`='$username' AND `password`='$password'"), 0);
if($captcha != $captcha_number ){
echo '<div class="thongbao">Invalid captcha</div>';
}else if($check < 1){
echo '<div class="thongbao">Invalid username or password</div>';
}else{
$res = mysql_fetch_assoc(mysql_query("SELECT * FROM `ACCOUNT` WHERE `username`='$username' AND `password`='$password'"));
$_SESSION['user'] = $res['id'];
echo '<meta http-equiv="refresh" content="0">';
}
}
}
?>
  <div class="panel-group">
    <div class="panel panel-primary">
      <div class="panel-heading">Login
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
            <input type="text" class="form-control" name="captcha" placeholder="Nhập mã xác nhận">                                        
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
<?php
}else{
$user = mysql_fetch_assoc(mysql_query("SELECT * FROM `ACCOUNT` WHERE `id`=".$_SESSION['user'].""));
?>
<div class="col-lg-12">
  <div class="panel-group">
    <div class="panel panel-primary">
      <div class="panel-heading">What is Vip Like ?
      </div>
      <div class="panel-body">
        + Hệ thống tự động nhân dạng id người dùng. Tự LIKE status,ảnh,video mới nhất. Sau khi mua xong, bạn chỉ cần đăng ảnh/status/video thì sẽ được tự động tăng like trong vòng 5-45p
        <br>+ Là một hệ thống hoạt động hoàn toàn tự động. 
        <br>+ Khi là V.I.P bạn sẽ không phải LIKE, SUB, COMMENT, SHARE cho bất cứ ai 
        <br>+ Bạn sẽ được bảo vệ thông tin bởi hệ thống. Chúng tôi không xóa tài khoản của bạn nếu bạn ko hoạt động trong ngày, không như member thường. 
        <br>+ Bạn không phải cập nhật token hàng ngày để like có thể lên đều, hệ thống chỉ cần id của bạn.
      </div>
    </div>
  </div>
</div>
<div class="col-lg-8">
  <?php
$like = array(0, 200, 500, 1000, 2000, 5000);
$vnd = array(0, 100000, 200000, 350000, 600000, 1000000);
if(isset($_POST['del'])){
$id = $_POST['id'];
mysql_query("DELETE FROM `VIP` WHERE `user`=".$user['id']." AND `idfb`='$id'");
echo '<div class="thongbao">Successful</div>';
}
if(isset($_POST['add'])){
$id = $_POST['id'];
$name = $_POST['name'];
$goi = $_POST['goi'];
mysql_query("CREATE TABLE IF NOT EXISTS `VIP` (
  `idfb` bigint(21) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user` int(10) NOT NULL,
  `goi` tinyint(1) NOT NULL,
  `time` int(10) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
");
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `VIP` WHERE `user`=".$user['id'].""), 0);
if(!$id || !$name || !$goi){
echo '<div class="thongbao">Please fill form fully</div>';
}else if($user['limit'] < $check) echo '<div class="thongbao">You have used the maximum ID</div>';
else if($user['vnd'] < $vnd[$goi]){
echo '<div class="thongbao">No enough money</div>';
}else{
mysql_query("UPDATE `ACCOUNT` SET `vnd`=`vnd`-'$vnd[$goi]' WHERE `id`=".$user['id']."");
$time = time()+30*24*3600;
mysql_query("INSERT INTO `VIP` SET `idfb`='$id', `name`='$name', `user`=".$user['id'].", `goi`='$goi', `time`='$time'");
echo '<div class="thongbao">Successful</div>';
}
}
?>
  <div class="panel-group">
    <div class="panel panel-primary">
      <div class="panel-heading">Panel Vip Like
      </div>
      <div class="panel-body">
        <form action="" method="POST">
          <div class="form-group">
            <label for="id">ID Facebook:
            </label>
            <input type="text" name="id" class="form-control">
          </div>
          <div class="form-group">
            <label for="name">Name Facebook:
            </label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label for="goi">Vip Package:
            </label>
            <select name="goi" class="form-control">
              <option value="1"><?= $like[1] ?> Like / Post / <?= $vnd[1] ?> VND
              </option>
              <option value="2"><?= $like[2] ?> Like / Post / <?= $vnd[2] ?> VND
              </option>
              <option value="3"><?= $like[3] ?> Like / Post / <?= $vnd[3] ?> VND
              </option>
              <option value="4"><?= $like[4] ?> Like / Post / <?= $vnd[4] ?> VND
              </option>
              <option value="5"><?= $like[5] ?> Like / Post / <?= $vnd[5] ?> VND
              </option>
            </select>
          </div>
          <button type="submit" name="add" class="btn btn-danger">Add
          </button>
          <button type="submit" name="del" class="btn btn-danger">Del
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-4">
  <div class="panel-group">
    <div class="panel panel-primary">
      <div class="panel-heading">Account Info
      </div>
      <div class="panel-body">
        <div class="form-group">
          <p>
            <li class="list-group-item">ID Nick:
              <?= $_SESSION['user'] ?>
            </li>
          </p>
          <p>
            <li class="list-group-item">Username:
              <?= $user['username'] ?>
            </li>
          </p>
          <p>
            <li class="list-group-item">Số Dư:
              <?= $user['vnd'] ?>
            </li>
          </p>
          <p>
            <li class="list-group-item">Tối Đa:
              <?=  $user['limit'] ?>
            </li>
          </p>
          <p>
            <a href="logout.php" class="btn btn-danger">Log Out
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-12">
  <div class="panel-group">
    <div class="panel panel-primary">
      <div class="panel-heading">
        ID VIP Like
      </div>
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th>ID Facebook
              </th>
              <th>Name Facebook
              </th>
              <th>Vip Package
              </th>
              <th>Time
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
$req = mysql_query("SELECT `idfb`, `name`, `goi`, `time` FROM `VIP` WHERE `user`=".$user['id']." LIMIT 10");
while($res = mysql_fetch_assoc($req)){
?>
            <tr>
              <td>
                <?= $res['idfb'] ?>
              </td>
              <td>
                <?= $res['name'] ?>
              </td>
              <td>
                <?= $like[$res['goi']] ?> Like
              </td>
              <td>
                <?= date("d/m/y", $res['time']) ?>
              </td>
            </tr>
            <?php
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
}
?>
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
