<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>登入頁面</title>
    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../assets/css/main.css" />
  </head>
  <body >
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-12">
          <section id="banner">
            <h2><strong>Rashow</strong> is a best poster playback system</h2>
            <p>ENTER Rashow </p>
          </section>
          <div class="panel panel-default">
            <div class="panel-body">
              <form class="form-horizontal" role="form" action="logincheck.php" method="post">
                <div class="form-group">

                  <label for="inputEmail3" class="col-sm-2 control-label">
                    Email
                  </label>
                  <div class="col-sm-6">
                    <input type="email" name="mail"class="form-control" id="inputEmail3" />
                  </div>
                </div>
                <div class="form-group">

                  <label for="inputPassword3" class="col-sm-2 control-label">
                    Password
                  </label>
                  <div class="col-sm-6">
                    <input type="password" name = "password" class="form-control" id="inputPassword3" />
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-6">
                    <div class="checkbox">
                      <!-- 狀態欄 -->
                      <div class="list-group">
                        <a href="./sign" class="list-group-item list-group-item-info" >還沒註冊嗎?</a>
                        <?php if ($_GET['sig_suc']==null&&$_GET['error']!=null): ?>
                          <a href="./forget/" class="list-group-item list-group-item-info">忘記密碼</a>
                        <?php endif; ?>
                      </div>
                        <?php if ($_GET['error']!=''): ?>
                            <div class="alert alert-warning" role="alert"><h2>錯誤!!</h2> <?php echo $_GET['error'] ?></div>
                        <?php endif; ?>
                        <?php if ($_GET['sig_suc']!=''): ?>
                          <div class="alert alert-success" role="alert"><h2>成功</h2> <?php echo $_GET['sig_suc'] ?></div>
                        <?php endif; ?>
                        <?php require_once "google_api_auth.php"; ?>
                        <?php if (isset($authUrl)): ?>
                            <a href=<?echo $authUrl; ?>>
                              <img src="https://i.stack.imgur.com/XzoRm.png" height = "50px" width ='auto'>
                            </a>
                        <?php endif; ?>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">

                    <button type="submit" class="btn btn-default">
                      Sign in
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
    		</div>
    	</div>
    </div>
    <!-- Scripts -->
      <script src="../assets/js/jquery.min.js"></script>
      <script src="../assets/js/skel.min.js"></script>
      <script src="../assets/js/util.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="../assets/js/main.js"></script>
  </body>
</html>
