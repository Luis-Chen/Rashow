<!DOCTYPE html>
<html lang="en">
   <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>播放頁面</title>
        <!-- Bootstrap -->
        <!-- 最新編譯和最佳化的 CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- 選擇性佈景主題 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- HTML5 shim and Respond.js 讓 IE8 支援 HTML5 元素與媒體查詢 -->
        <!-- 警告：Respond.js 無法在 file:// 協定下運作 -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
      <?php
        require_once "../method/connect.php";
        $select  = $connect -> prepare("SELECT * FROM poster WHERE sta_pass = 1 AND endDay - :today < 30  ORDER BY endDay limit 5");
        $select -> execute(array(':today' => date("Y-m-d")));

        $poster = $select -> fetchall(PDO::FETCH_ASSOC);
        $playlist = array();
        foreach ($poster as $key => $i) {
          $playlist[$key] = $poster[$key]['link'];
        }
      ?>
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
              <img src="../img/index.png" width="100%" />
          </div>
          <?php foreach ($poster as $key => $i) : ?>
            <div class="item">
              <img src="<?php echo $poster[$key]['link'];?>" width="100%" />
            </div>
          <?php endforeach; ?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
        <!-- jQuery (Bootstrap 所有外掛均需要使用) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- 依需要參考已編譯外掛版本（如下），或各自獨立的外掛版本 -->
        <!-- 最新編譯和最佳化的 JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
