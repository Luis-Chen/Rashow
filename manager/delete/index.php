<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>

    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

  </head>
  <body>
    <!-- 活動顯示頁面 -->
    <div class="jumbotron">
      <h1>Hello, world!</h1>
      <p>...</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
    </div>
    <!-- 主體 -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="panel panel-default">
            <div class="panel-body">
                      <?php require_once "../../method/menu.html"; ?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <?php
                  ini_set("display_errors", "On");
                 include_once("../../method/connect.php");
                 $select =  $connect -> prepare("SELECT * FROM poster WHERE sta_view = 1 AND sta_pass = 0");
                 $select -> execute();
                 $result = $select -> fetchall(PDO::FETCH_ASSOC) ;
                 ?>
                 <table class="table">
                 <?
                 foreach ($result as $result) {?>
                   <tr>
                    <td>編號<td>使用者<td>海報<td>上傳日期<td>結束日期<td>審核
                   <tr>
                     <td><?echo $result['id'];?>
                     <td><?echo $result['user'];?>
                     <td><a href="<?echo $result['link'];?>"><img src=" <?echo $result['link'];?>" alt="" width="100px" height="100px"></a>
                     <td><?echo $result['toDay'];?>
                     <td><?echo $result['endDate'];?>
                     <td>
                        <a href="setting.php?id=<?echo$result['id']; ?>">刪除</a>
                 <?}
                 ?>
                 <!-- 沒東西就顯示沒東西 -->
                 <?php if ($result == null): ?>
                   <h1>目前沒有任何資料</h1>
                 <?php endif; ?>
                 <!--                                         -->
               </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
