<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once "../method/connect.php";
      $select  = $connect -> prepare("SELECT * FROM poster WHERE sta_pass = 1 AND sta_play = 1 AND endDay - toDay < 30  ORDER BY endDay");
      $select -> execute();
      $poster = $select -> fetchall(PDO::FETCH_ASSOC);
    ?>
    <?php foreach ($poster as $poster ): ?>
      <img class="mySlides" src="<?echo $poster['link']?>">
    <?php endforeach; ?>
  </body>
</html>
