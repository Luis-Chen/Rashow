<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>
    <?php include "../method/include.html" ?>
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
                      工具列
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">

              <form name="add" class="form-horizontal" action="add.php" role="form"  method="post" enctype="multipart/form-data">

                <div class="form-group">
                  <span class="input-group-addon">上傳圖片</span>
                  <input type="file" class="form-control"  name="picture" data-toggle="tooltip" title="請上傳圖片">
                </div>

                <div class="form-group">
                  <span class="input-group-addon">結束日期</span>
                  <input type="date" class="form-control" name="endDate" id="endDate" data-toggle="tooltip" title="請輸入日期">
                </div>

                <input  type="button"  onclick="check()" class="btn btn-primary" value="送出">
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
