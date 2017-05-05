<?php
  require_once "../method/connect.php";
  if (isset($_POST['mb_search'])&&$_POST['mb_search']!='') {
    $select = $connect -> prepare("SELECT id,mail,date,level FROM member WHERE mail  like ?");
    $select -> execute(array($_POST['mb_search']));
  }else {
    $select = $connect -> prepare("SELECT id,mail,date,level FROM member ");
  }
    $select -> execute();

    $member  = $select -> fetchall(PDO::FETCH_ASSOC);
?>
<!-- /.row -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">使用者名單</h3>
        <div class="box-tools">
          <form  action="./level=1&type=member" method="post">
          <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="mb_search" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
          </div>
          </form>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <?php if (count($member)!=0): ?>
          <table class="table table-hover">
            <tr>
              <th>編號</th>
              <th>信箱</th>
              <th>註冊日期</th>
              <th>等級</th>
            </tr>
            <?php foreach ($member as $member ): ?>
                <tr>
                  <td><?php echo $member['id']; ?>
                  <td><?php echo $member['mail']; ?>
                  <td><?php echo $member['date']; ?>
                  <td>
                    <?php if ($member['level']==0): ?>
                      <span class="label label-success">使用者</span>
                    <?php else: ?>
                      <span class="label label-danger">管理者</span>
                    <?php endif; ?>
            <?php endforeach; ?>
          </table>
        <?php else: ?>
              <h2>目前沒有資料</h2>
        <?php endif; ?>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
