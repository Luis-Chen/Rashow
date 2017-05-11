<?php
  require_once "../method/connect.php";

    $select = $connect -> prepare("SELECT * FROM poster WHERE sta_view = 0");
    $select -> execute();

    $poster = $select -> fetchall(PDO::FETCH_ASSOC);
?>
  <?php if (count($poster)!=0): ?>
  <form class="" action="setting.php?view=0" method="post">
    <table class="table">
      <tr>
          <td>編號<td>會員編號<td>海報<td>上傳日期<td>結束日期<td>狀態<td>審核
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
            <td><h4>未審核</h4>
            <td>
                <input type="checkbox" name="pass[]" value="<?php echo $poster['id']?>">通過
                <input type="checkbox" name="notpass[]" value="<?php echo $poster['id']?>">未通過
      <?php endforeach; ?>
    </table>
      <input type="submit" name="" value="送出">
  </form>
  <?php else: ?>
        <h2>目前沒有資料</h2>
  <?php endif; ?>
