
  // if ($('[name = file]').val() =='' ) {
  //   //  $('[name = file ]').val() ==''    JQuery　打法
  //            alert("沒有上傳任何東西");
  //      }
  <?php if ($_GET['view']==0): ?>
    <form name="viewed_yn"  action="./setting.php" method="POST">
        <input type="radio" name="pass" value="0">未通過
        <input type="radio" name="pass" value="1">已通過
        <input type="hidden" name="id" value= "<?php echo $result['id']; ?>">
        <input type="submit"  value="送出">
      </form>
  <?php elseif ($_GET['view']==1&&$_GET['pass']==1); ?>
     <a href="setting.php?id=<?echo$result['id']; ?>">播放</a>
 <?php elseif ($_GET['view']==1&&$_GET['pass']==0); ?>
   <a href="setting.php?id=<?echo$result['id']; ?>">刪除</a>
  <?php endif; ?>
