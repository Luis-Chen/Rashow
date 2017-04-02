<?php
  session_start();
  if ($_SESSION["member"]!= null||$_SESSION["google"]!= null) {
    unset($_SESSION["member"]);
    unset($_SESSION["google"]);
    unset($_SESSION['access_token']);
  }
  header("location:../login/index.php");
 ?>
