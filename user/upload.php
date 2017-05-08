
<section id="two" class="wrapper style2 special">
  <div class="inner narrow">
    <header>
      <h2>上傳海報</h2>
    </header>
    <form id="add" name = "add" class="grid-form" action="add.php?type=<?echo $_GET['type']?>" role="form"  method="post" enctype="multipart/form-data">
      <div class="form-control narrow ">
        <label for="name">使用者</label>
        <?php echo $_SESSION['member']['mail']; ?>
      </div>
      <br>
      <div class="form-control narrow">
        <label for="picture">上傳圖片</label>
        <input  type="file"   name="picture"  title="請上傳圖片" id="picture">
      </div>
      <br>
      <div class="form-control narrow">
        <label for="endDay">海報結束播放日期</label>
        <input type="date"  name="endDay" title="請輸入日期">
        <input type="hidden" name="mbid" value="<?echo $_SESSION['member']['id'];?>">
        <input type="hidden" name="toDay"value="<? echo date('Y-m-d');?>">
      </div>
      <ul class="actions">
        <li><input  type="button"  onclick="check()"  value="送出"></li>
      </ul>
    </form>
  </div>
</section>

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
