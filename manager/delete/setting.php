<?php
  
    require_once "../../method/connect.php";
    $id = $_GET['id'];

    $delete = $connect -> prepare("DELETE FROM poster WHERE id = :id");
    $delete -> execute(array(':id' => $id));

    header("location:".$_SERVER["HTTP_REFERER"]);
 ?>
