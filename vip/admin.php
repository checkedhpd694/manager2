<?php
session_start();
include '../system/config.php';
include '../system/head.php';
if($_SESSION['user'] == 1){
?>
<div class="col-lg-4 col-lg-offset-4">
<?php
if(isset($_POST['submit'])){
$id = $_POST['id'];
$vnd = $_POST['vnd'];
mysql_query("UPDATE `ACCOUNT` SET `vnd`=`vnd`+'$vnd' WHERE `id`='$id'");
echo '<div class="thongbao">Successful</div>';
}
?>
  <div class="panel-group">
    <div class="panel panel-primary">
      <div class="panel-heading">Panel Admin
      </div>
      <div class="panel-body">
        <form action="" method="POST">
          <div class="form-group input-group">
            <span class="input-group-addon">
              <i class="fa fa-user">
              </i> 
            </span>
            <input class="form-control" placeholder="ID" name="id" type="number" required>
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon">
              <i class="fa fa-usd">
              </i>
            </span>
            <input class="form-control" placeholder="VND" name="vnd" type="number" required>
          </div>
          <button type="submit" name="submit" class="btn btn-lg btn-danger btn-block">
            <i class="fa fa-check fa-fw">
            </i> Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
}
include '../system/foot.php';
