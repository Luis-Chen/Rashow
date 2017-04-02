<?php
  require_once "../../method/connect.php";
  // 收信人及海報狀態系統寄信
  $userMail = array(
                                       'id'      => $_REQUEST['mbid'],
                                       'title'  => $_REQUEST['title'],
                                       'text'  => $_REQUEST['text'],
                                       'mail' => $_REQUEST['mail'],
                                       'date' => date("Y-m-d H:m:sa")
                                      );
  // 寄信給管理者
  require_once('../../method/phpmailer/PHPMailerAutoload.php');

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
  $mail->Subject ="[Rashow系統管理員發信]".$userMail['title']; //郵件標題
  $mail->Body ="
   <table>
    <tr>
      <td>寄件者
      <td>".$userMail['mail']."
    </tr>
    <tr>
      <td>標題
      <td>".$userMail['title']."
    </tr>
    <tr>
      <td>內容
      <td>".$userMail['text']."
    </tr>
    <tr>
      <td>日期
      <td>".$userMail['date']."
    </tr>
  </table>"
  $mail->IsHTML(true); //郵件內容為html
  $mail->AddAddress("f74373021@mailst.cjcu.edu.tw"); //收件者郵件及名稱
  $mail->AddBCC(" "); //設定 密件副本收件者
  if(!$mail->Send()){

  echo "Error: " . $mail->ErrorInfo;

  }else{

  echo "<b>發信成功!!</b>";

  }

  // 將訊息存進資料庫
  $insert = $connect -> prepare("INSERT INTO message (mbid,title,text,date)
                                                                  VALUES(?,?,?,?)");
  $insert -> execute(array($userMail['id'],$userMail['title'],$userMail['text'],$userMail['date']));

  header("location:".$_SERVER["HTTP_REFERER"]);
 ?>
