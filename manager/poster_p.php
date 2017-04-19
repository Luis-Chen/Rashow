<?php
  require_once "../method/connect.php";

    $select = $connect -> prepare("SELECT * FROM poster WHERE sta_play = 1 AND endDay > startplay ORDER BY endDay");
    $select -> execute();

    $poster = $select -> fetchall(PDO::FETCH_ASSOC);
?>
  <?php if (count($poster)!=0): ?>
  <form class="" action="setting.php?view=1&play=1" method="post">
    <table class="table">
      <tr>
          <td>編號<td>會員編號<td>海報<td>上傳日期<td>結束日期<td>開始播放時間<td>結束播放時間<td>狀態<td>下架
      <?php foreach ($poster as $poster ): ?>
          <tr>
            <td><?php echo $poster['id'] ?>
            <td><?php echo $poster['mbid']; ?>
            <td>
              <a href=<?php echo $poster['link']; ?>>
                <img src="<?php echo $poster['link']; ?>" alt="" height = "50px" width = "50px">
              </a>
            <td><?php echo $poster['toDay']; ?>
            <td><?php echo $poster['endDay']; ?>
            <td><?php echo $poster['startplay']; ?>
            <td>剩<?php echo round((strtotime($poster['endDay'])-strtotime($poster['startplay']))/3600/24)."天"; ?>
            <td><h4>播放中</h4>
            <td>
                <input type="checkbox" name="takeoff[]" value="<?echo $poster['id']?>">下架
      <?php endforeach; ?>
    </table>
      <input type="submit" name="" value="送出">
  </form>
  <?php else: ?>
        <h2>目前沒有資料</h2>
  <?php endif; ?>
