<?php
  require_once "../method/connect.php";

    $select = $connect -> prepare("SELECT * FROM poster WHERE sta_view = 1 AND sta_pass = 0 AND sta_del =0");
    $select -> execute();

    $poster = $select -> fetchall(PDO::FETCH_ASSOC);

?>
  <?php if (count($poster)!=0): ?>
  <form class="" action="setting.php?view=1&pass=0&deete=1" method="post">
    <table class="table">
      <tr>
          <td>編號<td>會員編號<td>海報<td>上傳日期<td>結束日期<td>狀態<td>修改<td>刪除
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
            <td><h4>未通過</h4>
            <td>
              <a href="setting.php?view=1&pass=0&setPass=1&id=<?php echo$poster['id']?>">還原</a>
            <td>
              <input type="checkbox" name="checkbox[]" value="<?php echo  $poster['id'] ?>">
      <?php endforeach; ?>
        <tr>
          <td><td><td><td><td><td><td><td><input type="submit" name="" value="送出">
    </table>
</form>
  <?php else: ?>
        <h2>目前沒有資料</h2>
  <?php endif; ?>
