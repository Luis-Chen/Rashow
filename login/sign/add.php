<?php
     $mail = $_POST['mail'];
     $password = $_POST['password'];
     $date = date("Y-m-d");
     require_once "../../method/connect.php";

     $insert = $connect -> prepare("INSERT INTO member(mail,password,date)
       VALUES(?,?,?)");
     $insert -> execute(array($mail,md5($password),$date));

    header("location:../?sig_suc=註冊成功");
 ?>
