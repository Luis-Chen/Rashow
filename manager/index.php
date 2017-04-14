<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>
    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <br>
        <img src="../img/LOGO.png" alt=""  width="100%" height="auto">
        <br>
        <br>
        <!-- 目錄 -->
        <div class="col-md-3">
            <?php require_once "../method/menu.php"; ?>
        </div>
        <!-- 主內容 -->
        <div class="col-md-9">
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
                          require_once "poster_play.php"; //播放中
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
    </div>
    <script type="text/javascript">
    function MM_open() {
            window.open(' ./mail/?mbid=<?echo $result['mbid']; ?>&posid=<?echo $result['id']; ?>', 'SendEmail', config='height=450,width=500,location=no,resizable=no,scrollbars=no');
    }
    </script>
    <!-- jQuery 必須先比bootstrap 引入不然會出錯 -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- 依需要參考已編譯外掛版本（如下），或各自獨立的外掛版本 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <!-- bootstrap -->
  </body>
</html>
