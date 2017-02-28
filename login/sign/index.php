<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>註冊頁面</title>
    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

  </head>
  <body>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-body">
          <form id = 'form' class="" action="./add.php" method="post">
            <div class="input-group">
              <input id ="mail" type="mail" name="mail" value="" placeholder="輸入註冊信箱">
            </div>
            <div class="input-group">
              <input  id ="pw"  type="password" name="password" value=""panel placeholder="輸入密碼">
            </div>
            <div class="input-group">
              <input id ="pwc"  type="password" name="pwcheck" value=""panel placeholder="再次輸入密碼">
            </div>
            <button type="submit" class = "btn btn-primary " name="button" >註冊</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
