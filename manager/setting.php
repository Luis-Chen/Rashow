<?php

      include("../method/connect.php");
      //審核
      $setPass = $_POST['setPass'];
      $id = $_GET['id'];

      //判斷是哪個頁面的指令
      $view = $_GET['view'];
      $pass = $_GET['pass'];

      //未審核頁面送過來的SQL指令
      if ($view=='upload'&&$pass==0) {
          $update = $connect -> prepare("UPDATE poster SET sta_view = 1 , sta_pass = ?  WHERE id = ?");
          $update -> execute(array($setPass,$id));
      }elseif ($view == true && $pass == true) {//已通過頁面指令
          $update = $connect -> prepare("UPDATE poster SET sta_play = 1 WHERE id = :id");
          $update -> execute(array(':id' => $id));
      }elseif ($view == true && $pass == false) {//未通過頁面指令
          $delete = $connect -> prepare("DELETE FROM poster WHERE id = :id");
          $delete -> execute(array(':id' => $id));
      }
      header("location:".$_SERVER["HTTP_REFERER"]);
 ?>
