<?php  ini_set("display_errors","On"); ?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>
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
                    <?php require_once "../method/menu.php"; ?>
            </div>
          </div>
        </div>

        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-body">
              <?php
                 include_once("../method/connect.php");?>

                <!-- // 海報 -->
                <?php if ($_GET['type']=='poster'): ?>
                <?
                    $view = $_GET['view'];
                    $pass = $_GET['pass'];

                    $select =  $connect -> prepare("SELECT * FROM poster WHERE sta_view = :v AND sta_pass = :p");
                    $select -> execute(array(':v' =>  $view,':p' => $pass));
                    $result = $select -> fetchall(PDO::FETCH_ASSOC) ;
                ?>
                  <table class="table">
                    <?php foreach($result as $result) :?>
                    <tr>
                      <td>編號<td>使用者<td>海報<td>上傳日期<td>結束日期<td>狀態<td>審核
                    <tr>
                       <td><?echo $result['id'];?>
                       <td><?echo $result['mbid'];?>
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
                        <form name="viewed_yn"  action="setting.php?id=<?echo$result['id']?>&view=<?echo$view?>&pass=<?echo$pass?>" method="POST">
                            <input type="radio" name="setPass" value="0">未通過
                            <input type="radio" name="setPass" value="1">已通過
                            <input type="submit"  value="送出">
                          </form>
                         <!-- 可播放 -->
                       <?php elseif ($view == true&&$pass == true): ?>
                          <a href="setting.php?id=<?echo$result['id'];?>&view=<?echo $view;?>&pass=<?echo $pass;?>" onclick="傳訊息給使用者">播放</a>
                        <!-- 刪除 -->
                        <?php elseif ($view == true &&$pass == false): ?>
                          <a href="setting.php?id=<?echo$result['id'];?>&view=<?echo $view;?>&pass=<?echo $pass;?>">刪除</a>
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
  </body>
</html>
