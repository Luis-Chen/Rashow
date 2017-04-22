<?php
  require_once "../method/connect.php";

    $select = $connect -> prepare("SELECT * FROM poster WHERE sta_pass = 1 ");
    // $select -> bindParam(':startPage', intval($startPage));
    // $select -> bindParam(':per', intval($per));
    $select -> execute();

    $poster = $select -> fetchall(PDO::FETCH_ASSOC);
?>
  <?php if (count($poster)!=0): ?>
  <form class="" action="setting.php?view=1&pass=1&setPass=0" method="post">
    <table class="table">
      <tr>
          <td>編號<td>會員編號<td>海報<td>上傳日期<td>結束日期<td>狀態<td>播放<td>未通過
      <?php foreach ($poster as $poster ): ?>
          <tr>
            <td><?php echo $poster['id'] ?>
            <td><?php echo $poster['mbid']; ?>
              <input type="hidden" name="member" value="<?php echo $poster['mbid']; ?>">
            <td>
              <a href=<?php echo $poster['link']; ?>>
                <img src="<?php echo $poster['link']; ?>" alt="" height = "50px" width = "50px">
              </a>
            <td><?php echo $poster['toDay']; ?>
            <td><?php echo $poster['endDay']; ?>
            <td><h4>已通過</h4>
            <td>
              <input type="checkbox" name="play[]" value="<?echo $poster['id']?>">
            <td>
              <input type="checkbox" name="notpass[]" value="<?echo $poster['id']?>">
      <?php endforeach; ?>
    </table>
    <input type="submit" name="" value="送出">
</form>
  <?php else: ?>
        <h2>目前沒有資料</h2>
  <?php endif; ?>
