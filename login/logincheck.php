<?php
    session_start();
    require_once "../method/connect.php";

   $mail = $_POST['mail'];
   $password = md5($_POST['password']);

   $select = $connect -> prepare("SELECT * FROM member WHERE mail = :mail AND password = :pw");
   $select -> execute(array(':mail' => $mail,':pw' => $password));

   $result = $select -> fetch(PDO::FETCH_ASSOC) ;

      if ($result['mail']==$mail&&$result['password']==$password) {

           $_SESSION['member'] = $result;

           if ($_SESSION['member']['level']==0) {
             header("location:../user/?level=0&page=upload");
           }elseif ($_SESSION['member']['level']==1) {
             header("location:../manager/?level=1&view=0&pass=0&type=poster");
           }

      }elseif ($result['password']!=$password||$result['mail']!=$account) {
                  header("location:./?error=帳密錯誤");
      }elseif ($result['password']!=''||$result['mail']!='') {
                  header("location:./?error=輸入不完全");
      }

 ?>
