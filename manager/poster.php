<?
    ini_set("display_errors", "On");
    if (!isset($_GET['view'])&&!isset($_GET['pass'])) {
      $select = $connect -> prepare("SELECT * FROM poster");
      $select -> execute();
    }else {
      $view = $_GET['view'];
      $pass = $_GET['pass'];

      $select =  $connect -> prepare("SELECT * FROM poster WHERE sta_view = :v AND sta_pass = :p LIMIT :startpage , :pagenum");
      $select -> bindValue(':startpage', (int) $startPage, PDO::PARAM_INT);
      $select -> bindValue(':pagenum', (int) 5, PDO::PARAM_INT);
      $select -> bindValue(':v',$view);
      $select -> bindValue(':p',$pass);
      $select -> execute();
    }

    $result = $select -> fetchall(PDO::FETCH_ASSOC);

?>
