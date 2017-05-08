<?php
      require_once("../method/connect.php");
      require_once("../method/phpmailer/PHPMailerAutoload.php");

      if (isset($_GET['setPass'])) {
        $setPass = $_GET['setPass'];
      }
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
      }
      if (isset($_GET['pass'])) {
        $pass = $_GET['pass'];
      }
      if (isset($_GET['play'])) {
        $play = $_GET['play'];
      }
      //判斷是哪個頁面的指令
      $view = $_GET['view'];

      //未審核頁面送過來的SQL指令
      if ($view== false) {
        if (isset($_POST['pass'])) {
          $pass = $_POST['pass'];
          foreach ($pass as $pass) {
              $update = $connect -> prepare("UPDATE poster SET sta_view = 1 , sta_pass= 1 WHERE id = :id");
              $update -> execute(array(':id' => $pass ));
            }
          }
          if (isset($_POST['notpass'])) {
            $notpass = $_POST['notpass'];
            foreach ($notpass as $notpass) {
                $update = $connect -> prepare("UPDATE poster SET sta_view = 1 , sta_pass= 0 WHERE id = :id");
                $update -> execute(array(':id' => $notpass ));
              }
          }
        }
      //已通過頁面指令
      if ($view == true && $pass == true){
        if (isset($_POST['play'])) {
          $play = $_POST['play'];
          $date = date("Y-m-d");
          var_dump($play);

          foreach ($play as $play) {

            $update = $connect -> prepare("UPDATE poster SET sta_play = 1 ,startplay = :d WHERE id = :id");
            $update -> execute(array(':id' => $play,':d' => $date ));

            $member = $connect -> prepare("SELECT mail FROM member WHERE :id ");
            $member -> execute(array(':id' => $_POST['member'] ));
            $member = $member -> fetch(PDO::FETCH_ASSOC);

            $poster = $connect -> prepare("SELECT * FROM poster WHERE :id");
            $poster -> execute(array(':id' =>  $play));
            $poster = $poster -> fetch(PDO::FETCH_ASSOC);

            $mail= new PHPMailer(); //建立新物件
            $mail->IsSMTP(); //設定使用SMTP方式寄信
            $mail->SMTPAuth = true; //設定SMTP需要驗證
            $mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
            $mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
            $mail->Port = 465; //Gamil的SMTP主機的埠號(Gmail為465)。
            $mail->CharSet = "utf-8"; //郵件編碼
            $mail->Username ="leo5916267@gmail.com"; //Gamil帳號
            $mail->Password = "ji32k7Gmail"; //Gmail密碼
            $mail->From = "leo5916267@gmail.com"; //寄件者信箱
            $mail->FromName = "Rashow管理員"; //寄件者姓名

            $mail->Body ="
             <table>
              <tr>
                <td>寄件者
                <td>Rashow管理員
              <tr>
                <td>標題
                <td>[海報審核][通過]
              <tr>
                <td>海報
                <td>".$poster['link']."
              <tr>
                <td>開始播放日期
                <td>".$date."
              <tr>
                <td>結束播放時間
                <td>".$poster['endDay']."
              </tr>
            </table>";
            $mail->IsHTML(true); //郵件內容為html
            $mail->AddAddress($member['mail']); //收件者郵件及名稱
            $mail->AddBCC(""); //設定 密件副本收件者
            if(!$mail->Send()){

            echo "Error: " . $mail->ErrorInfo;

            }else{
              // 將訊息存進資料庫
              $insert = $connect -> prepare("INSERT INTO message (mbid,title,text,date)
                                                                              VALUES(?,?,?,?)");
              $insert -> execute(array($_POST['member'],"[海報審核][通過]",$mail->Body,$date));

            }
            echo "<b>發信成功!!</b>";
            }


        }
        if (isset($_POST['notpass'])) {
          $check = $_POST['notpass'];
          var_dump($check);
          foreach ($check as $check) {
            $update = $connect -> prepare("UPDATE poster SET sta_pass= 0 WHERE id = :id");
            $update -> execute(array(':id' => $check ));
          }
        }
      }
      //未通過頁面指令
      if ($view == true && $pass == false) {
        if (isset($setPass)&&$setPass ==1 ) {
          $update = $connect -> prepare("UPDATE poster SET sta_pass = 1 WHERE id = :id");
          $update -> execute(array(':id' => $id ));
        }
        if (isset($_POST['checkbox'])) {
          $check = $_POST['checkbox'];
          var_dump($check);
          $date = date("Y-m-d");
          foreach ($check as $check) {
            $update = $connect -> prepare("UPDATE poster SET sta_del = 1 WHERE id = :id");
            $update -> execute(array(':id' => $check ));

            $member = $connect -> prepare("SELECT mail FROM member WHERE :id ");
            $member -> execute(array(':id' => $_POST['member'] ));
            $member = $member -> fetch(PDO::FETCH_ASSOC);

            $poster = $connect -> prepare("SELECT * FROM poster WHERE :id");
            $poster -> execute(array(':id' =>  $check));
            $poster = $poster -> fetch(PDO::FETCH_ASSOC);

            $mail= new PHPMailer(); //建立新物件
            $mail->IsSMTP(); //設定使用SMTP方式寄信
            $mail->SMTPAuth = true; //設定SMTP需要驗證
            $mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
            $mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
            $mail->Port = 465; //Gamil的SMTP主機的埠號(Gmail為465)。
            $mail->CharSet = "utf-8"; //郵件編碼
            $mail->Username ="leo5916267@gmail.com"; //Gamil帳號
            $mail->Password = "ji32k7Gmail"; //Gmail密碼
            $mail->From = "leo5916267@gmail.com"; //寄件者信箱
            $mail->FromName = "Rashow管理員"; //寄件者姓名

            $mail->Body ="
             <table>
              <tr>
                <td>寄件者
                <td>Rashow管理員
              <tr>
                <td>標題
                <td>[海報審核][未通過]
              <tr>
                <td>海報
                <td>".$poster['link']."
              <tr>
                <td>原因
                <td>未符合海報繳交規定，若有需求請重新上傳
              <tr>
                <td>刪除日期
                <td>".$date."
              </tr>
            </table>";
            $mail->IsHTML(true); //郵件內容為html
            $mail->AddAddress($member['mail']); //收件者郵件及名稱
            $mail->AddBCC(""); //設定 密件副本收件者
            if(!$mail->Send()){

            echo "Error: " . $mail->ErrorInfo;

            }else{
              // 將訊息存進資料庫
              $insert = $connect -> prepare("INSERT INTO message (mbid,title,text,date)
                                                                              VALUES(?,?,?,?)");
              $insert -> execute(array($_POST['member'],"[海報審核][未通過]",$mail->Body,$date));

            }
            echo "<b>發信成功!!</b>";

          }
        }
      }
      // 播放列表頁面
      if ($view == true && $play == true) {
        if (isset($_POST['takeoff'])) {
          $check = $_POST['takeoff'];
          var_dump($check);
          foreach ($check as $check) {
            $update = $connect -> prepare("UPDATE poster SET sta_play = 0 AND sta_pass = 0  WHERE id = :id");
            $update -> execute(array(':id' => $check ));
          }
        }
      }
      header("location:".$_SERVER["HTTP_REFERER"]);
 ?>
