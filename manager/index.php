<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>
    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

  </head>
  <body>
    <!-- 活動框 -->
    <div class="jumbotron">
      <h1>Hello, world!</h1>
      <p>...</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
    </div>

    <div class="container-fluid">
      <div class="row">
        <!-- 目錄 -->
        <div class="col-md-3">
            <?php require_once "../method/menu.php"; ?>
        </div>
        <!-- 主內容 -->
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-body">
              <?php
                 include_once("../method/connect.php");?>
                <!-- // 海報 -->
                <?php if ($_GET['type']=='poster'): ?>
                <?
                    if (!isset($_GET['view'])&&!isset($_GET['pass'])) {
                      $select =  $connect -> prepare("SELECT * FROM poster");
                      $select -> execute();
                    }else {
                      $view = $_GET['view'];
                      $pass = $_GET['pass'];
                      $select =  $connect -> prepare("SELECT * FROM poster WHERE sta_view = :v AND sta_pass = :p");
                      $select -> execute(array(':v' =>  $view,':p' => $pass));
                    }
                      $result = $select -> fetchall(PDO::FETCH_ASSOC) ;
                      $count = count($result);
                      $_SESSION['page'] = $count;
                ?>
                  <table class="table">
                    <?php foreach($result as $result) :?>
                    <tr>
                      <td>編號<td>使用者<td>海報<td>上傳日期<td>結束日期<td>狀態<td>審核
                    <tr>
                       <td><?echo $result['id'];?>
                       <td><a  onclick="MM_open();"><?echo $result['mbid'];?></a>
                       <td><a href="<?echo $result['link'];?>"><img src=" <?echo $result['link'];?>" alt="" width="100px" height="100px"></a>
                       <td><?echo $result['toDay'];?>
                       <td><?echo $result['endDate'];?>
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
                        <td>
                          <!-- 未通過 -->
                        <?php if ($view == false && $pass == false ): ?>
                            <a href="setting.php?id=<?echo$result['id'];?>&view=0&pass=0&setPass=0" onclick="傳訊息給使用者">未通過</a>
                            <a href="setting.php?id=<?echo$result['id'];?>&view=0&pass=0&setPass=1" onclick="傳訊息給使用者">通過</a>
                         <!-- 可播放 -->
                       <?php elseif ($view == true && $pass == true): ?>
                          <a href="setting.php?id=<?echo$result['id'];?>&view=1&pass=1" onclick="傳訊息給使用者">播放</a>
                          <a href="setting.php?id=<?echo$result['id'];?>&view=1&pass=1>&setPass=0" onclick="MM_open()">未通過</a>
                        <!-- 刪除 -->
                        <?php elseif ($view == true && $pass == false): ?>
                          <a href="setting.php?id=<?echo$result['id'];?>&view=1&pass=0&setPass=1" onclick="MM_open()">通過</a>
                        <?php endif; ?>
                      <?php endforeach; ?>

                <?php if ($_GET['type']=='poster'&&$result == null): ?>
                  <h1>目前沒有任何資料</h1>
                <?php endif; ?>
              </table>
            <?php elseif ($_GET['type']=='member'): ?>
            <?php
                      $select =  $connect -> prepare("SELECT * FROM member ");
                      $select -> execute();
                      $mb= $select -> fetchall(PDO::FETCH_ASSOC);
            ?>
                  <table class="table">
                    <tr>
                      <td>編號<td>使用者<td>註冊日期<td>權限
                        <?php foreach ($mb as $mb): ?>
                          <tr>
                            <td><?echo $mb['id'];?>
                            <td><?echo $mb['mail'];?>
                            <td><?echo $mb['date'];?>
                            <td>
                                    <?php if ($mb['level']==true): ?>
                                      <h6>管理者</h6>
                                    <?php elseif($mb['level']==false): ?>
                                      <h6>使用者</h6>
                                    <?php endif; ?>
                        <?php endforeach; ?>
                    </table>
            <?php endif; ?>
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
