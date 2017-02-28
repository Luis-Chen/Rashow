<?php
  require_once("../method/connect.php");

  $picture = $_FILES['picture'];
  $user = $_POST['member'];
  $endDate = $_POST['endDate'];
  $fileName  = $picture['tmp_name'];
  $toDay = $_POST['toDay'];
  if($_FILES["picture"]["error"]==0){
      // move_uploaded_file($_FILES["file"]["tmp_name"],
      // iconv("UTF-8", "big5", "../picture/".$_FILES["file"]["name"] ));//防止中文檔名亂碼
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
      // if($url!=""){
      //     echo "<h2>Uploaded Without Any Problem</h2>";
      //     echo "<img src='$url'/>";
      //     echo "你好";
      //   }else {
      //     echo "失敗". $pms['data']['error'];
      //   }
  }else {
      echo"fileErrorCode:".$_FILES["file"]["error"];
  }


  $insert = $connect -> prepare( "INSERT INTO
                      poster (
                              link,
                              endDate,
                              toDay,
                              user
                            ) VALUES (
                              ?,?,?,?
                            )");
  $insert -> execute(
          array(
                       $filelink,
                       $endDate,
                       $toDay,
                       $user
                     ));
  header("location:".$_SERVER["HTTP_REFERER"]);
 ?>
