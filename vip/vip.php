<?php
include '../system/config.php';
include '../system/head.php';
$like = array(0, 200, 500, 1000, 2000, 5000);
$vnd = array(0, 100000, 200000, 350000, 600000, 1000000);
$contact = '<a class="btn btn-danger" href="https://www.facebook.com/messages/t/AlwaysTrustPeopleFoReVer" target="_blank">Mua Ngay</a>';
?>
<div class="col-lg-8 col-lg-offset-2">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <i class="fa fa-thumbs-o-up">
      </i> Vip Like Tương Tác
    </div>
    <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Gói Like/Post
            </th>
            <th>Số Post/1 Ngày
              <br>
            </th>
            <th>Giá/1 Tháng
            </th>
            <th>
              <b>Liên Hệ
              </b>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?= $like[1] ?>+
            </td>
            <td>15
            </td>
            <td><?= $vnd[1] ?>
            </td>
            <td>
              <?= $contact ?>
            </td>
          </tr>
          <tr>
            <td><?= $like[2] ?>+
            </td>
            <td>15
            </td>
            <td><?= $vnd[2] ?>
            </td>
            <td>
              <?= $contact ?>
            </td>
          </tr>
          <tr>
            <td><?= $like[3] ?>+
            </td>
            <td>15
            </td>
            <td><?= $vnd[3] ?>
            </td>
            <td>
              <?= $contact ?>
            </td>
          </tr>
          <tr>
            <td><?= $like[4] ?>+
            </td>
            <td>15
            </td>
            <td><?= $vnd[4] ?>
            </td>
            <td>
              <?= $contact ?>
            </td>
          </tr>
          <tr>
            <td><?= $like[5] ?>+
            </td>
            <td>15
            </td>
            <td><?= $vnd[5] ?>
            </td>
            <td>
              <?= $contact ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
include '../system/foot.php';
