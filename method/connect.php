<?php
       ini_set("display_errors","On");
      date_default_timezone_set("Asia/Taipei");
     $link = array(
                              'host' => "10.128.108.12",
                               'port' => "3306",
                               'account' => "rashow",
                               'password' => "rashow",
                               'dbname' => "rashow"
                              );
    // $link = array(
    //                          'host' => "localhost",
    //                           'port' => "3306",
    //                           'account' => "root",
    //                           'password' => "root",
    //                           'dbname' => "rashow"
    //                          );
      $dbconnect =  'mysql:host='.$link['host'].';port='.$link['port'].';dbname='.$link['dbname'];

      // try 判斷是否連上 否:顯示訊息
      try {
        $connect=new PDO($dbconnect,$link['account'],$link['password']);
        $connect-> query("SET NAMES 'utf8'");
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch (Exception $e) {
            echo "Connection failed: ".$e->getMessage();
             exit();
      }
?>
