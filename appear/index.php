<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
    body {
      margin: 0;
      padding: 0;
      background: #111;
      height: 100%;
    }
    .diy-slideshow{
      position: relative;
      display: block;
      overflow: hidden;
    }
    figure{
      position: absolute;
      opacity: 0;
      transition: 1s opacity;
    }
    figcaption{
      position: absolute;
      font-family: sans-serif;
      font-size: .8em;
      bottom: .75em;
      right: .35em;
      padding: .25em;
      color: #fff;
      background: rgba(0,0,0, .25);
      border-radius: 2px;
    }
    figcaption a{
      color: #fff;
    }
    figure.show{
      opacity: 1;
      position: static;
      transition: 1s opacity;
    }
    .next, .prev{
      color: #fff;
      position: absolute;
      background: rgba(0,0,0, .6);
      top: 50%;
      z-index: 1;
      font-size: 2em;
      margin-top: -.75em;
      opacity: .3;
      user-select: none;
    }
    .next:hover, .prev:hover{
      cursor: pointer;
      opacity: 1;
    }
    .next{
      right: 0;
      padding: 10px 5px 15px 10px;
      border-top-left-radius: 3px;
      border-bottom-left-radius: 3px;
    }
    .prev{
      left: 0;
      padding: 10px 10px 15px 5px;
      border-top-right-radius: 3px;
      border-bottom-right-radius: 3px;
    }
    p{
      margin: 10px 20px;
      color: #fff;
    }
    a{color:#fff;}
    </style>
    <?php
      require_once "../method/connect.php";
      $select  = $connect -> prepare("SELECT * FROM poster WHERE sta_pass = 1 AND endDay - toDay < 30  ORDER BY endDay limit 5");
      $select -> execute();
      $poster = $select -> fetchall(PDO::FETCH_ASSOC);
      $playlist = array();
      foreach ($poster as $key => $i) {
        $playlist[$key] = $poster[$key]['link'];
      }
    ?>
  </head>
  <body>
    <div id="my_div" >
      <div class="diy-slideshow">
         <figure class="show">
           <img src="<?php echo $poster[4]['link'];?>" width="100%" />
        </figure>
        <?php foreach ($poster as $key => $i) : ?>
          <figure>
            <img src="<?php echo $poster[$key]['link'];?>" width="100%" />
          </figure>
        <?php endforeach; ?>
        <span class="prev">&laquo;</span>
        <span class="next">&raquo;</span>
      </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- 循環播放 -->

   <!-- 循環播放 -->
    <script type="text/javascript">
      var counter = 0, // 追蹤當前幻燈片
              $items = $('.diy-slideshow figure'), // 所有幻燈片集合
              numItems = $items.length; // 幻燈片總數
      var showCurrent = function(){
      var itemToShow = Math.abs(counter%numItems);// 使用餘數運算福來獲取要顯示的元素的實際索引
      $items.removeClass('show'); // 從任何當前的元素中刪除.show
      $items.eq(itemToShow).addClass('show');
    };
    // 新增上一個下一個按鈕
    $('.next').on('click', function(){
        counter++;
        showCurrent();
      });
      $('.prev').on('click', function(){
        counter--;
        showCurrent();
      });

      if('ontouchstart' in window){
        $('.diy-slideshow').swipe({
          swipeLeft:function() {
            counter++;
            showCurrent();
          },
          swipeRight:function() {
            counter--;
            showCurrent();
          }
        });
      }
     </script>
  </body>
</html>
