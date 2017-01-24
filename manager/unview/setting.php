<?php
      ini_set("display_errors","On");
      include("../../method/connect.php");
      $pass = $_POST['pass'];
      $id = $_POST['id'];
      // 管理者看過
      $update = $connect -> prepare("UPDATE poster SET sta_view = :view WHERE id = :id");
      $update -> execute(array(':view' => 1 ,':id' => $id));
      //海報通過
      $update = $connect -> prepare("UPDATE poster SET sta_pass = :pass WHERE id = :id");
      $update -> execute(array(':pass' => $pass,':id' => $id));

        header("location:./index.php");
 ?>
