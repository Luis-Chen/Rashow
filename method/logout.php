<?php
  session_start();
  if ($_SESSION["member"]!= null) {
    unset($_SESSION["member"]);
  }
  header("location:../login/index.php");
 ?>
