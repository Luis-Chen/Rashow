<?php
          $select =  $connect -> prepare("SELECT * FROM member ");
          $select -> execute();
          $mb= $select -> fetchall(PDO::FETCH_ASSOC);
?>
