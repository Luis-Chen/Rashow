  function check() {
    var getDate  = new Date();
    var toDay = getDate.getFullYear() + "-" +  (getDate.getMonth()+1) + "-" + getDate.getDate();
    var endDate = add.endDate.value;
    var picture =  add.picture.value;
    var checkType = true;  //是否檢查圖片副檔名
	  var fileType = /\.(jpg|gif|png)$/i;  //允許的圖片副檔名

    if (endDate == '') {
            alert("請輸入日期");
    }else if (picture  == '') {
            alert('請上傳檔案');
    }else if (checkType && !fileType.test(picture)) {
    		     alert("只允許上傳JPG、PNG、GIF影像檔");
    }else {
      add.submit();
    }


  }
  // if ($('[name = file]').val() =='' ) {
  //   //  $('[name = file ]').val() ==''    JQuery　打法
  //            alert("沒有上傳任何東西");
  //      }
