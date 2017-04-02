<?php
// 資料庫連線
require_once "../method/connect.php";
require_once "google_api_auth.php";

// 若取得google 登入的使用者資訊，資料存進會員並給SESSION

 $user = $service->userinfo->get(); //get user info
  // 將使用者資料寫進資料庫
  $ggselect = $connect -> prepare("SELECT * FROM member WHERE google_id = :user_id");
  $ggselect -> execute(array(':user_id' =>  $user->id));

  $gginfo = $ggselect -> fetch(PDO::FETCH_ASSOC);

  if ($gginfo == null) {
    $gginsert = $connect -> prepare("INSERT INTO member (mail,google_id,date) VALUES (?,?,?)");
    $gginsert -> execute( array($user->email,$user->id,date("Y-m-d")));

  }else {

      $_SESSION['member'] = $gginfo;
      var_dump($_SESSION['member']);
       header("location:../user/?level=0&page=upload");

  }



?>
