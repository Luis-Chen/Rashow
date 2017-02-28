<?php
  session_start();
  if ($_SESSION["member"]!= null) {
    unset($_SESSION["member"]);
  }
  require_once "../login/index.php";
 ?>
