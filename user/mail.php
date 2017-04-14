<form name="mail" class="form-horizontal" action="add.php?type=<?echo $_GET['type']?>&level=<?echo $_GET['level']?>" role="form"  method="post" enctype="multipart/form-data">
<div class="form-group">
    <span class="input-group-addon">使用者</span>
    <? echo $_SESSION['member']['mail']?>
  </div>
  <div class="form-group">
    <span class="input-group-addon">標題</span>
    <input  type="text" class="form-control"  name="title" data-toggle="tooltip" title="輸入標題">
  </div>
  <div class="form-group">
    <span class="input-group-addon">內容</span>
    <textarea class="form-control" rows="3" name="text"></textarea>
  </div>
  <input type="hidden" name="mbid" value="<?echo $_SESSION['member']['id'];?>">
  <input type="hidden" name="mail" value="<?echo $_SESSION['member']['mail'];?>">
  <input type="hidden" name="toDay"value="<? echo date('Y-m-d');?>">

  <input  type="submit"  onclick="" class="btn btn-primary" value="送出">
</form>
