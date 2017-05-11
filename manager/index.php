<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>
    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <br>
        <img src="../img/LOGO.png" alt=""  width="100%" height="auto">
        <br>
        <br>
        <!-- 目錄 -->
          <?php require_once "../method/menu.php"; ?>
        <!-- 主內容 -->
          <div class="panel panel-default">
            <div class="panel-body">
              <?php

                if($_GET['level'] == 1){

                  switch ($_GET['type']) {
                    case 'poster':
                        if (isset($_GET['view'])&&$_GET['view'] == 0)
                         {
                          require_once "poster_v.php";  //j未審核
                         }
                        if (isset($_GET['pass'])&&$_GET['pass'] == 1)
                        {
                          require_once "poster_y.php"; //通過
                        }
                        if (isset($_GET['pass'])&&isset($_GET['view'])&&$_GET['pass'] == 0 && $_GET['view'] == 1)
                        {
                          require_once "poster_n.php"; //未通過
                        }
                        if (isset($_GET['play'])&&$_GET['play'] == 1)
                        {
                          require_once "poster_p.php"; //播放中
                        }
                      break;
                    case 'member':
                          require_once "member.php"; //會員
                      break;
                  }
                }else {
                  require_once "../method/logut.php";
                }
               ?>
            </div>
          </div>
      </div>
    </div>
    <!-- jQuery 必須先比bootstrap 引入不然會出錯 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- 依需要參考已編譯外掛版本（如下），或各自獨立的外掛版本 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <!-- bootstrap -->
  </body>
</html>
