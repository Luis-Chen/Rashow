<?php
  require_once "../method/connect.php";
  $select =  $connect -> prepare("SELECT * FROM poster WHERE mbid = :mbid");
  $select -> execute(array(':mbid' => $_SESSION['member']['id']));
  $result= $select -> fetchall(PDO::FETCH_ASSOC);
?>
<table class="table">
<?php if ($result == null): ?>
  <h1>目前沒有任何資料</h1>
<?php endif; ?>
<?php foreach($result as $result):?>
<tr>
 <td>編號<td>海報<td>上傳日期<td>結束日期<td>開始播放時間<td>剩餘時間<td>狀態
<tr>
  <td><?php echo $result['id'];?>
  <td><a href="<?php echo $result['link'];?>"><img src=" <?php echo $result['link'];?>" alt="" width="100px" height="100px"></a>
  <td><?php echo $result['toDay'];?>
  <td><?php echo $result['endDay'];?>
    <?php if ($result['startplay'] == "0000-00-00"): ?>
        <td>-
        <td>-
      <?php else: ?>
        <td><?php echo $result['startplay']; ?>
        <td><?php echo round((strtotime($result['endDay'])-strtotime($result['startplay']))/3600/24)."天"; ?>
    <?php endif; ?>
  <td>
    <?php if ($result['sta_view']==false): ?>
      <h6>未看過</h6>
    <?php elseif ($result['sta_pass']==true): ?>
      <h6>已通過</h6>
    <?php elseif ($result['sta_pass']==false): ?>
      <h6>未通過</h6>
    <?php elseif ($result['sta_play']==true): ?>
      <h6>播放中</h6>
    <?php endif; ?>
 <?php endforeach; ?>
</table>
