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
                 require_once "../method/connect.php";
                   $SQL = "SELECT COUNT(*) as total FROM ".$_GET['type'];
                   $row = $connect -> query($SQL) -> fetch(PDO::FETCH_ASSOC);
                   $row = (int)$row['total'];
                   $page = ceil($row/5);
                   var_dump($page);
                   if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
                     $page=1; //則在此設定起始頁數
                   } else {
                     $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
                   }
                   $startPage = ($page -1) * 5;
           ?>
                 <!-- 海報 -->
                <?php if ($_GET['type']=='poster'): ?>
                  <?

                      if (!isset($_GET['view'])&&!isset($_GET['pass'])) {
                        $select = $connect -> prepare("SELECT * FROM poster");
                        $select -> execute();
                      }else {
                        $view = $_GET['view'];
                        $pass = $_GET['pass'];

                        $select =  $connect -> prepare("SELECT * FROM poster WHERE sta_view = :v AND sta_pass = :p LIMIT :startpage , 5");
                        $select -> bindValue(':startpage', (int) $startPage, PDO::PARAM_INT);
                        $select -> bindValue(':v',$view);
                        $select -> bindValue(':p',$pass);
                        $select -> execute();
                      }
                      $result = $select -> fetchall(PDO::FETCH_ASSOC);
                  ?>
                  <table class="table">
                    <?php foreach($result as $result) :?>
                    <tr>
                       <td>編號<td>使用者<td>海報<td>上傳日期<td>結束日期<td>狀態
                       <?php if (isset($_GET['view'])&&isset($_GET['pass'])): ?>
                       <td>審核
                       <?php endif; ?>
                    <tr>
                       <td><?echo $result['id'];?>
                       <td><a  onclick="MM_open();"><?echo $result['mbid'];?></a>
                       <td><a href="<?echo $result['link'];?>"><img src=" <?echo $result['link'];?>" alt="" width="100px" height="100px"></a>
                       <td><?echo $result['toDay'];?>
                       <td><?echo $result['endDay'];?>
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
                         <?php if (isset($_GET['view'])&&isset($_GET['pass'])): ?>
                           <td><!-- 未通過 -->
                             <?php if ($view == false && $pass == false ): ?>
                                <a href="setting.php?id=<?echo$result['id'];?>&view=0&pass=0&setPass=1" >通過</a>
                                <a href="setting.php?id=<?echo$result['id'];?>&view=0&pass=0&setPass=0" onclick="MM_open()">未通過</a>
                                <!-- 可播放 -->
                             <?php elseif ($view == true && $pass == true): ?>
                                <a href="setting.php?id=<?echo$result['id'];?>&view=1&pass=1&setPass=1" onclick="MM_open()">播放</a>
                                <a href="setting.php?id=<?echo$result['id'];?>&view=1&pass=1>&setPass=0" onclick="MM_open()">未通過</a>
                           <!-- 刪除 -->
                              <?php elseif ($view == true && $pass == false): ?>
                                <a href="setting.php?id=<?echo$result['id'];?>&view=1&pass=0&setPass=1" >還原</a>
                              <?php endif; ?>
                         <?php endif; ?>
                      <?php endforeach; ?>
                <?php if ($_GET['type']=='poster'&&$result == null): ?>
                  <h1>目前沒有任何資料</h1>
                <?php endif; ?>
              </table>
              <ul class="pagination">
                    <li>
                           <a href="./index.php?page=1&level=1&type=<?echo$_GET['type']?>">Prev</a>
                    <?php for($i = 1 ;$i<=$page; $i++ ): ?>
                      <li>
                          <a href="./index.php?page=<?echo $i?>&level=1&type=<?echo$_GET['type']?>"><?echo $i; ?></a>
                    <?php endfor; ?>
                    <li>
                          <a href="./index.php?page=<?echo $page?>&level=1&type=<?echo$_GET['type']?>">Next</a>
              </ul>
            <?php elseif ($_GET['type']=='member'): ?>
                  <?php require_once "./member.php"; ?>
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
                  <?php echo $page;?>
                  <ul class="pagination">
                        <li>
                               <a href="./?page=1&level=1&type=<?echo$_GET['type']?>">Prev</a>
                        <?php for($i = 1 ;$i<=$page; $i++ ): ?>
                          <li>
                              <a href="./?page=<?echo $i;?>&level=1&type=<?echo $_GET['type']?>"><?echo $i; ?></a>
                        <?php endfor; ?>
                        <li>
                              <a href="./?page=<?echo $page;?>&level=1&type=<?echo$_GET['type']?>">Next</a>
                  </ul>
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
