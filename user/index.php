<?php   session_start();  ?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>
    <!-- 定時登出 -->
    <meta http-equiv="refresh" content="600;url = ../method/logout.php">

    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <br>
        <img src="../img/LOGO.png" alt=""  width="100%" height="auto">
        <br>
        <br>
        <div class="col-md-3">
          <div class="panel panel-default">
            <div class="panel-body">
              <?php require_once "../method/menu.php" ?>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">

              <?php if ($_GET['type']=='upload'): ?>
                <?php require_once "upload.php"; ?>

              <?php elseif ($_GET['type']=='his'):  ?>    <!-- 觀看上傳紀錄 -->
                <?php require_once "history.php" ?>

              <?php elseif ($_GET['type']=='mail'):  ?><!-- 發送訊息 -->
                <?php require_once "mail.php" ?>

              <?php elseif ($_GET['type']=='mes'): ?><!-- 檢查訊息 -->
                <?php require_once "message.php" ?>

              <?php endif; ?>
                <!-- jQuery 必須先比bootstrap 引入不然會出錯 -->
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
                <!-- 依需要參考已編譯外掛版本（如下），或各自獨立的外掛版本 -->
                <script src="../bootstrap/js/bootstrap.min.js"></script>
                <!-- bootstrap -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
