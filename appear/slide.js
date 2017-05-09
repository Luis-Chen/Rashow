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
