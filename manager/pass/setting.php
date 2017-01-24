<?php
    ini_set("display_errors", "On");
    require_once "../../method/connect.php";
    $id = $_GET['id'];

    $update = $connect -> prepare("UPDATE poster SET sta_play = 1 WHERE id = :id");
    $update -> execute(array(':id' => $id));

    header("location:".$_SERVER["HTTP_REFERER"]);
 ?>
