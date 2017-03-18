<?php
  require_once("../method/connect.php");

  $page = $_GET['page'];
  $level = $_GET['level'];

  if ($page=='upload'&&$level==0) {
    $picture = $_FILES['picture'];
      $fileName  = $picture['tmp_name'];

    $mbid = $_POST['mbid'];
    $endDate = $_POST['endDate'];
    $toDay = $_POST['toDay'];

    if($_FILES["picture"]["error"]==0){
        // move_uploaded_file($_FILES["picture"]["tmp_name"],
        // iconv("UTF-8", "big5", "./picture/".$_FILES["picture"]["name"] ));//防止中文檔名亂碼
        $client_id = "5b982131a30952e";
        $handle = fopen($fileName,"r");
        $data = fread($handle,filesize($fileName));
        $pvars  = array('image' => base64_encode($data));
        $timeout = 30;
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,'https://api.imgur.com/3/image.json');
        curl_setopt($curl,CURLOPT_TIMEOUT,$timeout);//讀取時間30秒為上限
        curl_setopt($curl,CURLOPT_HTTPHEADER,array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);//關閉SSL安全
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $pvars);
        $out = curl_exec($curl);
        curl_close ($curl);
        $pms = json_decode($out,true);
        $filelink=$pms['data']['link'];

        echo $filelink;

    }else {
        echo"fileErrorCode:".$_FILES["picture"]["error"];
    }

    $insert = $connect -> prepare( "INSERT INTO  poster (link,mbid,endDate,toDay
                                                                                                ) VALUES (?,?,?,? )");
    $insert -> execute(array($filelink, $mbid, $endDate,$toDay));
  }elseif ($page=='mail'&&$level==0) {

    $mbid =  $_POST['mbid'];
    $mail = $_POST['mail'];
    $title = $_POST['title'];
    $text= $_POST['text'];
    $date = $_POST['toDay'];

    // 將訊息存進資料庫
    $insert = $connect -> prepare("INSERT INTO message (mbid,title,text,date)
                                    VALUES(?,?,?,?)");
    $insert -> execute(array($mbid,$title,$text,$date));
  }

  header("location:".$_SERVER["HTTP_REFERER"]);
 ?>
