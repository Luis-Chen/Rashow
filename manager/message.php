<?php
  require_once "../method/connect.php";
    $select = $connect -> prepare("SELECT * FROM message");
    $select -> execute();

    $message  = $select -> fetchall(PDO::FETCH_ASSOC);
?>
<!-- /.row -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">訊息表單</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <?php if (count($message)!=0): ?>
          <table class="table table-hover">
            <tr>
              <th>編號</th>
              <th>會員編號</th>
              <th>標題</th>
              <th>內容</th>
              <th>日期</th>
            </tr>
            <?php foreach ($message as $message ): ?>
                <tr>
                  <td><?php echo $message['id']; ?>
                  <td><?php echo $message['mbid']; ?>
                  <td><?php echo $message['title']; ?>
                  <td><?php echo $message['text']; ?>
                  <td><?php echo $message['date']; ?>
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
