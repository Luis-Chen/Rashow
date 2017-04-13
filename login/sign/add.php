<?php
     $mail = $_POST['mail'];
     $password = $_POST['password'];
     $date = date("Y-m-d");
     require_once "../../method/connect.php";

     $select = $connect -> prepare("SELECT mail FROM member");
     $select -> execute();
     $result = $select -> fetchall(PDO::FETCH_ASSOC) ;
     var_dump($result);
     $i = 0;
     $same = false;
     while($result[$i]['mail'] == $mail){
        $same = ture;
         header("location:./?same=已有相同帳號");
         $i++;
     }
     if ( $same == false) {
       $insert = $connect -> prepare("INSERT INTO member(mail,password,date)
         VALUES(?,?,?)");
       $insert -> execute(array($mail,md5($password),$date));

      header("location:../?sig_suc=註冊成功");
     }

 ?>
