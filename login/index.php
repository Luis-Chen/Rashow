<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>登入頁面</title>
    <!-- bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

  </head>
  <body >
    <div class="container">
      <div class="row">
       <div class="col-md-6 col-md-offset-3" >
         <div class="panel panel-primary">
           <div class="panel-heading">
             <b><h2>Login</h2></b>
           </div>
           <div class="panel-body">
             <form class="form-signin" role="form" action="logincheck.php" method="post">
               <label for="inputEmail" class="sr-only">Email address</label>
               <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus=""  name="mail">
               <label for="inputPassword" class="sr-only">Password</label>
               <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">
               <br>
               <div class="list-group">
                 <a href="./sign" class="list-group-item list-group-item-info">還沒註冊嗎?</a>
                 <?php if ($_GET['sig_suc']!=''): ?>
                   <li class="list-group-item list-group-item-success"><?php echo $_GET['sig_suc'] ?>
                 <?php endif; ?>
                 <?php if ($_GET['error']!=''): ?>
                   <li class="list-group-item list-group-item-danger"><?php echo $_GET['error'] ?>
                 <?php endif; ?>
               </div>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
           </div>
         </div>
       </div>
      </div>
   </div>
  </body>
</html>
