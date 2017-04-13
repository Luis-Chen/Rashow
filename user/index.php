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

              <?php if ($_GET['type']=='upload'&&$_GET['level']==0): ?>
                <form name="add" class="form-horizontal" action="add.php?type=<?echo $_GET['type']?>" role="form"  method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <span class="input-group-addon">使用者</span>
                    <? echo $_SESSION['member']['mail']?>
                  </div>
                  <div class="form-group">
                    <span class="input-group-addon">上傳圖片</span>
                    <input  type="file" class="form-control"  name="picture" data-toggle="tooltip" title="請上傳圖片" id="picture">
                  </div>
                  <div class="form-group">
                    <span class="input-group-addon">海報結束播放日期</span>
                    <input type="date" class="form-control" name="endDay" data-toggle="tooltip" title="請輸入日期">
                    <input type="hidden" name="mbid" value="<?echo $_SESSION['member']['id'];?>">

                    <input type="hidden" name="toDay"value="<? echo date('Y-m-d');?>">
                  </div>
                  <input  type="button"  onclick="check()" class="btn btn-primary" value="送出">
                </form>
                <progress value="0" max="100" id="progressBar" style="width:300px;"></progress>
                <h3 id="status"></h3>
                <p id="loaded_n_total"></p>
                  <!-- 上傳判斷 -->
                  <script type="text/javascript">
                    function check() {
                      var toDay = add.toDay.value;
                      var endDay = add.endDay.value;
                      var picture =  add.picture.value;
                      var checkType = true;  //是否檢查圖片副檔名
                      var fileType = /\.(jpg|gif|png)$/i;  //允許的圖片副檔名

                      if (endDay == '') {
                              alert(endDay + "請輸入日期");
                            }else if ( endDay < toDay) {
                              alert("[輸入錯誤]日期:" + endDay + " ，結束日期早於今日");
                            }else if (picture  == '') {
                              alert('請上傳檔案');
                            }else if (checkType && !fileType.test(picture)) {
                              alert("只允許上傳JPG、PNG、GIF影像檔");
                            }else {
                              function _(e1) {
                                return document.getElementById(e1);
                              }
                                var file = _("picture").files[0];
                                alert(file.name+"|"+file.size+"|"+file.type);
                                var formdata =new FormData();
                                formdata.append("picture",file);
                                var ajax = new XMLHttpRequest();
                                ajax.upload.addEventListener("progress",progressHandler,false);
                                ajax.addEventListener("load",completeHandler,false);
                                ajax.addEventListener("error",errorHandler,false);
                                ajax.addEventListener("abort",abortHandler,false);
                                ajax.open("POST","add.php?type=<?echo $_GET['type']?>");
                                ajax.send(formdata);

                              function progressHandler(e) {
                                _("loaded_n_total").innerHTML = "Upload"+event.loaded + "bytes of " + event.total;
                                var percent = (event.loaded /event.total) * 100;
                                _("progressBar").value = Math.round(percent);
                                _("status").innerHTML = Math.round(percent) + "% upload... please wait";

                              }
                              function completeHandler(e) {
                                _("status").innerHTML = event.target.responseText;
                                _("progressBar").value = 0;
                              }
                              function errorHandler(e) {
                                _("status").innerHTML = "Upload Failed";
                              }
                              function abortHandler(e) {
                                _("status").innerHTML = "Upload Aborted";
                              }
                            }
                      }
                  </script>
                  <!-- 進度條 -->
                  <script type="text/javascript">

                  </script>
              <!-- 觀看上傳紀錄 -->
              <?php elseif ($_GET['type']=='his'&&$_GET['level']==0):  ?>
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
                  <td><?echo $result['endDay'];?>
                  <td><?php echo round((strtotime($result['endDay'])-strtotime($result['toDay']))/3600/24)."天"; ?>
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
               <!-- 發送訊息 -->
              <?php elseif ($_GET['type']=='mail'&&$_GET['level']==0):  ?>
                <form name="mail" class="form-horizontal" action="add.php?type=<?echo $_GET['type']?>&level=<?echo $_GET['level']?>" role="form"  method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <span class="input-group-addon">使用者</span>
                    <? echo $_SESSION['member']['mail']?>
                  </div>
                  <div class="form-group">
                    <span class="input-group-addon">標題</span>
                    <input  type="text" class="form-control"  name="title" data-toggle="tooltip" title="輸入標題">
                  </div>
                  <div class="form-group">
                    <span class="input-group-addon">內容</span>
                    <textarea class="form-control" rows="3" name="text"></textarea>
                  </div>
                  <input type="hidden" name="mbid" value="<?echo $_SESSION['member']['id'];?>">
                  <input type="hidden" name="mail" value="<?echo $_SESSION['member']['mail'];?>">
                  <input type="hidden" name="toDay"value="<? echo date('Y-m-d');?>">

                  <input  type="submit"  onclick="" class="btn btn-primary" value="送出">
                </form>
                <!-- 檢查訊息 -->
              <?php elseif ($_GET['type']=='mes'&&$_GET['level']==0): ?>
                <?php
                  require_once "../method/connect.php";
                  $select =  $connect -> prepare("SELECT * FROM message WHERE mbid = :mbid");
                  $select -> execute(array(':mbid' => $_SESSION['member']['id']));
                  $meg= $select -> fetchall(PDO::FETCH_ASSOC);
                ?>
                <?php if ($meg  == null): ?>
                    <h1>目前沒有任何資料</h1>
                <?php else: ?>
                  <table class="table">
                    <?php foreach($meg as $meg):?>
                    <tr>
                      <td>標題<td>內容<td>日期
                    <tr>
                       <td><?echo  $meg['title'] ?>
                       <td><?echo  $meg['text'];?>
                       <td><?echo  $meg['date'];?>
                    <?php endforeach; ?>
                    </table>
                  <?php endif; ?>
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
