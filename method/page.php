<!-- 頁數 -->
<?php
  $SQL = "SELECT COUNT(*) as total FROM ".$_GET['type'];
  $row = $connect -> query($SQL) -> fetch(PDO::FETCH_ASSOC);
    var_dump((int)$row['total']);
  $row = (int)$row['total'];
  $page = ceil($row/5);
  var_dump($page);
  if (!isset($_GET["page"])){ //假$如$_GET["page"]未設置
    $page=1; //則在此設定起始頁數
  } else {
    $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
  }
  $startPage = ($page -1) * 5;
 ?>
