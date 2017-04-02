<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  </head>
  <body>
    <?php
           require_once "../../method/connect.php";
           $mbSelect = $connect -> prepare("SELECT mail FROM member WHERE id = :mbid");
           $mbSelect -> execute(array(':mbid' => $_GET['mbid'] ));
           $mbMail = $mbSelect -> fetch(PDO::FETCH_ASSOC);
     ?>
    <div class="container-fluid">

      <div class="row">

        <div class="panel panel-default">
          <div class="panel-body">
            <form action="setting.php">
                    <div class = "form-horizontal">
                        <div class = "form-group">
                            <label class = "control-label col-sm-3" for = "email"> 電子郵件 </label>
                            <div class = "col-sm-9">
                              <div class="panel panel-default">
                                <div class="panel-body">
                                  <?php echo $mbMail['mail'];  ?>
                                  <input type="hidden" name="mail" value="<?php echo $mbMail['mail']; ?>">
                                  <input type="hidden" name="mbid" value="<?php echo $_GET['mbid'] ; ?>">
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "control-label col-sm-3" for = "title"> 標題 </label>
                            <div class = "col-sm-9">
                                <input class = "form-control" type = "text" name = "title" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class = "control-label col-sm-3" for="text">內容</label>
                            <div class = "col-sm-9">
                               <textarea class="form-control" ondragover="" name="text" rows="8" ></textarea>
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class = "col-sm-9 col-sm-offset-3">
                                <button type = "submit" clas s= "btn btn-primary">發送</button>
                            </div>
                        </div>
                    </div>
                </form>
          </div>
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
