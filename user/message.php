<?php
  require_once "../method/connect.php";
  $select =  $connect -> prepare("SELECT * FROM message WHERE mbid = :mbid");
  $select -> execute(array(':mbid' => $_SESSION['member']['id']));
  $meg= $select -> fetchall(PDO::FETCH_ASSOC);
?>
<?php if ($meg  == null): ?>
    <h1>目前沒有任何資料</h1>
<?php else: ?>
  <table class="table">
    <?php foreach($meg as $meg):?>
    <tr>
      <td>標題<td>內容<td>日期
    <tr>
       <td><?php echo  $meg['title'] ?>
       <td><?php echo  $meg['text'];?>
       <td><?php echo  $meg['date'];?>
    <?php endforeach; ?>
    </table>
  <?php endif; ?>
