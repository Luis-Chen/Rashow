<section id="two" class="wrapper style2 special">
  <div class="inner narrow">
    <header>
      <h2>寄信給管理者</h2>
    </header>
    <form class="grid-form" method="post" action="add.php?type=<?php echo $_GET['type']?>" id="form">
      <div class="form-control narrow">
        <label for="email">Email</label>
        <?php echo $_SESSION['member']['mail'];?>
        <input type="hidden" name="mbid" value="<?php echo $_SESSION['member']['id'];?>">
      </div>
      <div class="form-control narrow">
        <label for="title">標題</label>
        <input  type="text" class="form-control" id = "title"  name="title" data-toggle="tooltip" title="輸入標題">
      </div>

      <div class="form-control">
        <label for="text">內容</label>
        <textarea class="form-control" rows="3"  id = "text"  name="text"></textarea>
      </div>

      <ul class="actions">
        <li><input value="Send Message" type="button" onclick="check()"></li>
      </ul>
    </form>
  </div>
</section>
<script type="text/javascript">
function check() {
  var title = document.getElementById('title').value;
  var text = document.getElementById('text').value;

  if (title == '') {
    alert("請輸入標題");
  }
  if (text =='') {
    alert("請輸入內容");
  }
  if (title!=''&&text!='') {
    document.getElementById("form").submit();
  }
}
</script>
