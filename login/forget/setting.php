<?php
     $mail = $_POST['mail'];
     $password = $_POST['password'];
     require_once "../../method/connect.php";

       $update = $connect -> prepare("UPDATE member SET password = :ps  WHERE mail = :mail");
       $update -> execute(array(':ps' => md5($password),':mail' => $mail));

      header("location:../?sig_suc=修改成功");
 ?>
