<?php
  require_once "../method/connect.php";

    $select = $connect -> prepare("SELECT id,mail,date,level FROM member ");
    $select -> execute();

    $member  = $select -> fetchall(PDO::FETCH_ASSOC);
?>
  <?php if (count($member)!=0): ?>
    <table class="table">
      <tr>
          <td>編號<td>信箱<td>註冊日期<td>等級
      <?php foreach ($member as $member ): ?>
          <tr>
            <td><?php echo $member['id']; ?>
            <td><?php echo $member['mail']; ?>
            <td><?php echo $member['date']; ?>
            <td>
              <?php if ($member['level']==0): ?>
                <h6>使用者</h6>
              <?php else: ?>
                <h6>管理者</h6>
              <?php endif; ?>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
        <h2>目前沒有資料</h2>
  <?php endif; ?>
