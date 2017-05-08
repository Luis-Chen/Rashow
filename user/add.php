<?php
  require_once("../method/connect.php");

  ini_set("max_execution_time", "300");
  // 檔案過大上傳時間會很久
  if ( $_GET['type'] == 'upload') {
    $picture = $_FILES['picture'];
      $fileName  = $picture['tmp_name'];
    $mbid = $_POST['mbid'];
    $endDay = $_POST['endDay'];
    $toDay = $_POST['toDay'];

    if($picture["error"]==0){
        // move_uploaded_file($_FILES["picture"]["tmp_name"],
        // iconv("UTF-8", "big5", "./picture/".$_FILES["picture"]["name"] ));//防止中文檔名亂碼
        $client_id = "5b982131a30952e";
        $handle = fopen($fileName,"r");
        $data = fread($handle,filesize($fileName));
        $pvars  = array('image' => base64_encode($data));
        $timeout = 300;
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,'https://api.imgur.com/3/image.json');
        curl_setopt($curl,CURLOPT_TIMEOUT,$timeout);//讀取時間300秒為上限
        curl_setopt($curl,CURLOPT_HTTPHEADER,array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl,CURLOPT_POST,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);//關閉SSL安全
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_NOPROGRESS,false);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $pvars);
        $out = curl_exec($curl);
        curl_close ($curl);
        $pms = json_decode($out,true);
        $filelink=$pms['data']['link'];
        echo $filelink;
        if ($filelink!=null) {
          $insert = $connect -> prepare( "INSERT INTO  poster (link,mbid,endDay,toDay
                                                                                                      ) VALUES (?,?,?,? )");
          $insert -> execute(array($filelink, $mbid, $endDay,$toDay));
        }

      }else {
          echo"fileErrorCode:".$_FILES["picture"]["error"];
      }
    }elseif( $_GET['type'] =='mail') {
      $userInfo = array('title'   => $_POST['title'],
                                          'text'    => $_POST['text'],
                                          'mbid' =>$_POST['mbid'],
                                          'mail'   =>$_POST['mail'],
                                          'toDay' => $_POST['toDay']
                              );
      require_once('../method/phpmailer/PHPMailerAutoload.php');

        $mail= new PHPMailer(); //建立新物件
        $mail->IsSMTP(); //設定使用SMTP方式寄信
        $mail->SMTPAuth = true; //設定SMTP需要驗證
        $mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
        $mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
        $mail->Port = 465; //Gamil的SMTP主機的埠號(Gmail為465)。
        $mail->CharSet = "utf-8"; //郵件編碼
        $mail->Username ="f74373021@mailst.cjcu.edu.tw"; //Gamil帳號
        $mail->Password = "asd123456"; //Gmail密碼
        $mail->From = $userInfo['mail']; //寄件者信箱
        $mail->FromName = "[Rashow使用者]".$userInfo['mail']; //寄件者姓名
        $mail->Subject ="[Rashow使用者發信]".$userInfo['title']; //郵件標題
        $mail->Body ="
        <table border =1>
          <tr>
            <td>寄件者
            <td>".$userInfo['mail']."
          </tr>
          <tr>
            <td>標題
            <td>".$userInfo['title']."
          </tr>
          <tr>
            <td>內容
            <td>".$userInfo['text']."
          </tr>
          <tr>
            <td>日期
            <td>".$userInfo['toDay']."
          </tr>
        </table>";//郵件內容
        $mail->IsHTML(true); //郵件內容為html
        $mail->AddAddress("f74373021@mailst.cjcu.edu.tw"); //收件者郵件及名稱
        $mail->AddBCC(" "); //設定 密件副本收件者

        if(!$mail->Send()){

          echo "Error: " . $mail->ErrorInfo;

        }else{
          $insert = $connect -> prepare("INSERT INTO message (mbid,title,text,date)
                                                                          VALUES(?,?,?,?)");
          $insert -> execute(array($userInfo['mbid'],$userInfo['title'],$userInfo['text'],$userInfo['toDay']));
          echo "<b>發信成功!!</b>";

        }

    }
    header("location:".$_SERVER["HTTP_REFERER"]);
 ?>
