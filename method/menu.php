
<?php if ($_GET['level']==1): ?>
  <ul class="actions">
    <li class="button "><a href="./?view=0&pass=0&level=1&type=poster">未審核頁面</a>
    <li class="button "><a href="./?view=1&pass=1&level=1&type=poster">已通過頁面</a></li>
    <li class="button "><a href="./?view=1&pass=0&level=1&type=poster">未通過頁面</a></li>
    <li class="button "><a href="./?view=1&play=1&level=1&type=poster">播放監控</a></li>

    <li class="button "><a href="./?level=1&type=member">會員管理</a></li>
    <li class="button "><a href="./?level=1&type=member">數據分析</a></li>
    <li class="button special"><a href="../method/logout.php">登出</a></li>
  </ul>
<?php elseif($_GET['level']==0): ?>
  <section id="one" class="wrapper special">
    <div class="inner">
      <header class="major">
        <h2>使用者功能表單</h2>
      </header>
      <div class="features">

          <div class="feature">
            <i class="fa fa-copy"></i>
              <a href="./?type=upload&level=0">
                <h3>上傳海報</h3>
              </a>
            <p>上傳你的海報圖檔</p>
          </div>


          <div class="feature">
            <i class="fa fa-paper-plane-o"></i>
              <a href="./?type=mail&level=0">
                <h3>留言給管理員</h3>
              </a>
            <p>有任何問題請寄信給管理員</p>
          </div>

          <div class="feature">
            <i class="fa fa-save"></i>
              <a href="./?type=his&level=0">
                <h3>歷史紀錄</h3>
              </a>
            <p>檢視您上傳過的紀錄</p>
          </div>


          <div class="feature">
            <i class="fa fa-envelope-o"></i>
              <a href="./?type=mes&level=0">
                <h3>訊息</h3>
              </a>
              <p>檢視海報審核結果及訊息</p>
          </div>

          <div class="feature">
            <i class="fa fa-diamond"></i>
              <a href="../method/logout.php">
                <h3>登出</h3>
              </a>
                <p>登出你的帳戶</p>
          </div>
      </div>
    </div>
  </section>
<?php endif; ?>
