<?php if ($_GET['member']!=null): ?>
  <ul class="list-group">
    <li class="list-group-item"><a href="../unview/">未審核頁面</a></li>
    <li class="list-group-item"><a href="../pass/">已通過頁面</a></li>
    <li class="list-group-item"><a href="../delete/">未通過頁面</a></li>
    <li class="list-group-item"><a href="../method/logout.php">登出</a></li>
  </ul>
<?php elseif($_GET['user']!=null): ?>
  <ul class="list-group">
    <li class="list-group-item"><a href="../unview/">訊息</a></li>
    <li class="list-group-item"><a href="../pass/">留言給管理員</a></li>
    <li class="list-group-item"><a href="../delete/">上傳紀錄</a></li>
    <li class="list-group-item"><a href="../method/logout.php">登出</a></li>
  </ul>
<?php endif; ?>
