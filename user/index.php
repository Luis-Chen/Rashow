<?php   session_start();  ?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>
    <!-- 定時登出 -->
    <meta http-equiv="refresh" content="600;url = ../method/logout.php">

    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

  </head>

  <body>

    <div class="jumbotron">
      <h1>Hello, world!</h1>
      <p>...</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
    </div>

    <div class="container-fluid">
      <div class="row">

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
              <?php if ($_GET['page']=='upload'&&$_GET['level']==0): ?>
                <form name="add" class="form-horizontal" action="add.php" role="form"  method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <span class="input-group-addon">使用者</span>
                    <? echo $_SESSION['member']['mail']?>
                  </div>
                  <div class="form-group">
                    <span class="input-group-addon">上傳圖片</span>
                    <input type="file" class="form-control"  name="picture" data-toggle="tooltip" title="請上傳圖片">
                  </div>
                  <div class="form-group">
                    <span class="input-group-addon">海報結束播放日期</span>
                    <input type="date" class="form-control" name="endDate" data-toggle="tooltip" title="請輸入日期">
                    <input type="hidden" name="mbid" value="<?echo $_SESSION['member']['id'];?>">

                    <input type="hidden" name="toDay"value="<? echo date('Y-m-d');?>">
                  </div>
                  <input  type="button"  onclick="check()" class="btn btn-primary" value="送出">
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%" id="upload_progress">
                      <span class="sr-only">45% Complete</span>
                    </div>
                  </div>
                </form>


                  <!-- 圖片上傳API -->
                  <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
                  <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js">
                  </script>
                  <!-- 上傳判斷 -->
                  <script type="text/javascript">
                    function check() {
                      var toDay = add.toDay.value;
                      var endDate = add.endDate.value;
                      var picture =  add.picture.value;
                      var checkType = true;  //是否檢查圖片副檔名
                      var fileType = /\.(jpg|gif|png)$/i;  //允許的圖片副檔名

                      if (endDate == '') {
                              alert(endDate + "請輸入日期");

                            }else if ( endDate < toDay) {
                              alert("[輸入錯誤]日期:" + endDate + " ，結束日期早於今日");
                            }else if (picture  == '') {
                              alert('請上傳檔案');
                            }else if (checkType && !fileType.test(picture)) {
                              alert("只允許上傳JPG、PNG、GIF影像檔");
                            }else {
                              add.submit();
                            }
                          }
                  </script>
                  <!-- 進度條 -->
                  <script type="text/javascript">
                  

                  </script>
              <?php elseif ($_GET['page']=='his'&&$_GET['level']==0):  ?>
                <?php
                  require_once "../method/connect.php";
                  $select =  $connect -> prepare("SELECT * FROM poster WHERE mbid = :mbid");
                  $select -> execute(array(':mbid' => $_SESSION['member']['id']));
                  $result= $select -> fetchall(PDO::FETCH_ASSOC);

                ?>
             <table class="table">
               <?php foreach($result as $result):?>
               <tr>
                 <td>編號<td>海報<td>上傳日期<td>結束日期<td>剩餘時間<td>狀態
               <tr>
                  <td><?echo $result['id'];?>
                  <td><a href="<?echo $result['link'];?>"><img src=" <?echo $result['link'];?>" alt="" width="100px" height="100px"></a>
                  <td><?echo $result['toDay'];?>
                  <td><?echo $result['endDate'];?>
                  <td><?php echo round((strtotime($result['endDate'])-strtotime($result['toDay']))/3600/24)."天"; ?>
                  <td>
                    <?php if ($result['sta_view']==false): ?>
                      <h6>未看過</h6>
                    <?php elseif ($result['sta_pass']==true): ?>
                      <h6>已通過</h6>
                    <?php elseif ($result['sta_pass']==false): ?>
                      <h6>未通過</h6>
                    <?php elseif ($result['sta_play']==true): ?>
                      <h6>播放中</h6>
                    <?php endif; ?>
                 <?php endforeach; ?>
               </table>
              <?php elseif ($_GET['page']=='mail'&&$_GET['level']==0):  ?>
                <form class="" action="index.html" method="post">

                </form>
              <?php endif; ?>
                <!-- jQuery 必須先比bootstrap 引入不然會出錯 -->
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
                <!-- 依需要參考已編譯外掛版本（如下），或各自獨立的外掛版本 -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
                <!-- bootstrap -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
