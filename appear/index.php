<HTML>
<link rel=stylesheet type="text/css" href="./slide.css">
<script type="text/javascript" src="./slide.js"></script>
<script type="text/javascript">
<!--  //隨機播放陣列中指定的圖檔
        var jsImg = new Array("001.jpg","002.jpg","003.jpg","004.jpg","005.jpg");
        //設定每兩秒執行一次randomImg() ，此行要在 function 之外
        setInterval("randomImg()",2000);
        function randomImg(){
        //陣列的長度 * 介於0~1間數字 ，然後在取 floor 當照片索引值
        var imgIndex = Math.floor(Math.random()*jsImg.length);
        document.getElementById("my_div").innerHTML  = "<img src='"+jsImg[imgIndex]+"' width=100% height=100%>";
        }
-->
</script>
<script type="text/javascript">
<!--  //循序播放陣列中指定的圖檔
        var jsImg = new Array("001.jpg","002.jpg","003.jpg","004.jpg","005.jpg");
        var jsImg_len = jsImg.length;  // 圖檔數量
        // 要用另一個變數存，是不想在 function 中每次都要算陣列的大小
        var i=2;                       //起始照片  2 為 003.jpg
        //設定每兩秒執行一次sequentialImg() ，此行要在 function 之外
        setInterval("sequentialImg()",2000);
        function sequentialImg(){  //循序播放
            document.getElementById("my_div").innerHTML  = "<img src='"+jsImg[i]+"' width=200 height=200>";
                i++;
                if(i>=jsImg_len)  i=0;
        }
-->
</script>
<body >
<!-- <body onload="randomImg();">  -->
<div id="my_div" >``
  <div class="diy-slideshow">

    <?php
      require_once "../method/connect.php";
      $select  = $connect -> prepare("SELECT * FROM poster WHERE sta_pass = 1 AND endDay - toDay < 30  ORDER BY endDay");
      $select -> execute();
      $poster = $select -> fetchall(PDO::FETCH_ASSOC);
    ?>
  	<figure class="show">
      <?php foreach ($poster as $poster => $i): ?>
        <img src="<? echo $poster[$i]['link'];?>" width="100%" />
      <?php endforeach; ?>
  	</figure>

    <span class="prev">&laquo;</span>
    <span class="next">&raquo;</span>

  </div>
</body>
</HTML>
