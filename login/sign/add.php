<?php
     $mail = $_POST['mail'];
     $password = $_POST['password'];
     $date = date("Y-m-d");
     require_once "../../method/connect.php";

     $select = $connect -> prepare("SELECT mail FROM member");
     $select -> execute();
     $result = $select -> fetchall(PDO::FETCH_ASSOC) ;
     //var_dump($result);
     $i = 0;
     $same = false;
     if ($result['0']['mail']==$mail) {
       echo "stting";
     }else {
       echo "string";
     }

     foreach ($result as $value) {
       if ($value['mail'] == $mail) {
         $same = true;
         header("location:./?same=已有相同帳號");
       }

     }
     if ( $same == false) {
       $insert = $connect -> prepare("INSERT INTO member(mail,password,date)
         VALUES(?,?,?)");
       $insert -> execute(array($mail,md5($password),$date));

      header("location:../?sig_suc=註冊成功");
     }

 ?>
