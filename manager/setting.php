<?php
      require_once("../method/connect.php");

      if (isset($_GET['setPass'])) {
        $setPass = $_GET['setPass'];
      }
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
      }
      if (isset($_GET['pass'])) {
        $pass = $_GET['pass'];
      }
      if (isset($_GET['play'])) {
        $play = $_GET['play'];
      }
      //判斷是哪個頁面的指令
      $view = $_GET['view'];

      //未審核頁面送過來的SQL指令
      if ($view== false) {
        if (isset($_POST['pass'])) {
          $pass = $_POST['pass'];
          foreach ($pass as $pass) {
              $update = $connect -> prepare("UPDATE poster SET sta_view = 1 , sta_pass= 1 WHERE id = :id");
              $update -> execute(array(':id' => $pass ));
            }
          }
          if (isset($_POST['notpass'])) {
            $notpass = $_POST['notpass'];
            foreach ($notpass as $notpass) {
                $update = $connect -> prepare("UPDATE poster SET sta_view = 1 , sta_pass= 0 WHERE id = :id");
                $update -> execute(array(':id' => $notpass ));
              }
          }
        }
      //已通過頁面指令
      if ($view == true && $pass == true){
        if (isset($_POST['play'])) {
          $play = $_POST['play'];
          $date = date("Y-m-d");
          var_dump($play);
          foreach ($play as $play) {
            $update = $connect -> prepare("UPDATE poster SET sta_play = 1 ,startplay = :d WHERE id = :id");
            $update -> execute(array(':id' => $play,':d' => $date ));
          }
        }
        if (isset($_POST['checkbox'])) {
          $check = $_POST['checkbox'];
          var_dump($check);
          foreach ($check as $check) {
            $update = $connect -> prepare("UPDATE poster SET sta_pass= 0 WHERE id = :id");
            $update -> execute(array(':id' => $check ));
          }
        }
      }
      //未通過頁面指令
      if ($view == true && $pass == false) {
        if ($setPass ==1 ) {
          $update = $connect -> prepare("UPDATE poster SET sta_pass = 1 WHERE id = :id");
          $update -> execute(array(':id' => $id ));
        }
        if (isset($_POST['checkbox'])) {
          $check = $_POST['checkbox'];
          var_dump($check);
          foreach ($check as $check) {
            $update = $connect -> prepare("UPDATE poster SET sta_del = 1 WHERE id = :id");
            $update -> execute(array(':id' => $check ));
          }
        }
      }
      // 播放列表頁面
      if ($view == true && $play == false) {
        if (isset($_POST['takeoff'])) {
          $check = $_POST['takeoff'];
          var_dump($check);
          foreach ($check as $check) {
            $update = $connect -> prepare("UPDATE poster SET sta_play = 0 AND sta_play = 0  WHERE id = :id");
            $update -> execute(array(':id' => $check ));
          }
        }
      }
      header("location:".$_SERVER["HTTP_REFERER"]);
 ?>
