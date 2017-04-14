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
                add.submit();
            }
    }
  </script>
