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
  <body >
    <div class="container">
      <div class="row">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

      </div>
      <div class="row">
       <div class="col-md-4 col-md-offset-4" >
         <div class="panel panel-primary">
           <div class="panel-heading">
             <b><h2>Sign</h2></b>
           </div>
           <div class="panel-body">

             <form id = 'form' name = 'form'  class="form-signin" role="form" action="./add.php" method="post">

                 <input id ="mail" type="email"  class="form-control" name="mail" value="" placeholder="輸入註冊信箱">
                 <br>
                 <input id ="pw"  type="password"  class="form-control"  name="password" value="" placeholder="輸入密碼">
                 <br>
                 <input id ="pwc"  type="password"  class="form-control" name="pwcheck" value="" placeholder="再次輸入密碼">
                 <br>
               <?php if ($_GET['same']!=''): ?>
                 <div class="alert alert-danger" role="alert">
                   <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                   <span class="sr-only">Error:</span>
                    <?php echo $_GET['same'] ?>
               </div>
               <?php endif; ?>
               <br>
                 <input type ="button"  class="btn btn-primary"   onclick="check()" value="SIGN">
             </form>

               <script type="text/javascript">
                 function check() {
                   if(document.getElementById('mail').value == '' || document.getElementById('pw').value == '' || document.getElementById('pwc').value == ''){
                     alert("表單填寫不完全");
                   }else {
                     var form = true;
                   }
                   if(document.getElementById('pw').value  != document.getElementById('pwc').value){
                     alert("密碼不相同");
                   }else {
                     var pass = true;
                   }
                   if (form == true &&  pass == true) {
                     document.getElementById('form').submit();
                   }
                 }
               </script>
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
