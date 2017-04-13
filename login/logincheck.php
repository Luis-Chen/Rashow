<?php
    session_start();
    // 資料庫連線
    require_once "../method/connect.php";

     // -----------------------------------------------預設登入
       $mail = $_POST['mail'];
       $password = md5($_POST['password']);

       $select = $connect -> prepare("SELECT * FROM member WHERE mail = :mail AND password = :pw ");
       $select -> execute(array(':mail' => $mail,':pw' => $password));

       $result = $select -> fetch(PDO::FETCH_ASSOC) ;

          if ($result['mail']==$mail && $result['password']==$password) {

               $_SESSION['member'] = $result;

               if ($_SESSION['member']['level']==0) {
                 var_dump($_SESSION['member']);
                 header("location:../user/?level=0&type==upload");
               }elseif ($_SESSION['member']['level']==1) {
                 header("location:../manager/?level=1&view=0&pass=0&type=poster&page=1");
               }

          }elseif ($result['password']!=$password||$result['mail']!=$account) {
                      //header("location:./?error=帳密錯誤");
                      echo $_SESSION['member'];
          }elseif ($result['password']!=''||$result['mail']!='') {
                      //header("location:./?error=輸入不完全");
          }
    //------------------------預設登入------------------------------------------------
 ?>
