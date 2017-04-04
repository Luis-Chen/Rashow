# Rashow
01/24
#Rashow/

[TOC]

##appeear/
目前沒有內容，組員負責寫。主要是改幻燈片程式碼，加入演算法，讓海報能有不同的播放頻率或統計翻頁次數及翻頁時間，分析出熱門時段並將播放優先權高的海報放到熱門時段。
##bootstrap/
前端框架
##login/
使用者與管理者登入的頁面
###forget/
當忘記密碼時，可以輸入會員帳號(註冊輸入的信箱)，輸入新密碼，表單會送出更新資料並跳轉回登入頁面 ../index.php
- ####index.php
	- 表單 action = "./setting.php"
		- 信箱欄位
		- 新密碼
		- 再次輸入新密碼
	- javaScript
		- 比對密碼有沒有輸入相同
- ####setting.php
	- 接收 ./index.php $_POST 資料
	-   require_once "../../method/connect.php";
	- PDO(UPDATE SET 語法)
	- 跳轉登入頁面傳$GET[輸入成功訊息]

###libraries/
google 快速登入API主要取用 ./Google/autoload.php 頁面
###sign/
註冊頁面
- ####index.php
	- 表單 action = "./add.php"
		- 信箱欄位
		- 新密碼
		- 再次輸入新密碼
	- javaScript
		- 比對密碼有沒有輸入相同
- ####add.php
	- 接收 ./index.php $_POST 資料
		-   require_once "../../method/connect.php";
		- PDO(SELECT FROM member 語法)
		- 判斷
			- if(已經註冊過了)
				- 跳轉登入頁面傳$_GET[已經有相同帳號]
			- else
				- PDO(INSERT INTO member 註冊資料) 
		- 跳轉登入頁面傳$GET[註冊成功]		

###google_api_auth.php
取得googleAPI授權。
- require_once "libraries/Google/autoload.php";//引入googeAPI
- if(得到授權)
	- 將授權存進$_SESSION['access_token']
	- 跳轉./googlecheck.php

參考頁面https://www.sanwebe.com/2012/11/login-with-google-api-php
###googlecheck.php
取得google使用者資料並存進資料庫。
-   require_once "../../method/connect.php";
- require_once "google_api_auth.php";
- if(資料庫沒有使用者資料)
	- PDO(INSERT INTO　使用者資料) 
- else
	- 將資料存進$_SESSION['member']
	- header("location:../user/?level=0&page=upload")
		- 跳轉使用者頁面並傳送$_GET[使用者變數]

###index.php
- 表單 action = "./loginchek.php"
	- 信箱欄位
	- 密碼
- google快速登入
- 狀態列

###logincheck.php
- 接收index.php $_POST資料
-   require_once "../../method/connect.php";
- PDO(SELECT FORM member WHERE = 帳號密碼的資料)
- 將資料存進$_SESSION['member']
- if($_SESSION['member']['level'] == 0)
	- header("location:../user/?level=0&page=upload")
		- 跳轉使用者頁面並傳送$_GET[使用者變數]
- elseif($_SESSION['member']['level'] == 1)
	- header("location:../manager/?level=1&view=0&pass=0&type=poster");
		- 跳轉管理者頁面並傳送$_GET[管理者變數]

##manager/
###mail/
寄信小視窗，當海報審核完必管理者可以立即發送訊息給使用者
 - ####index.php
 	- 使用者
 	- 標題
 	- 內容
 - ####setting.php
 	-   require_once "../../method/connect.php";
 	- require_once('../../method/phpmailer/PHPMailerAutoload.php');
 	- 寄信格式
 	- 將訊息INSERT INTO  message 
 	- 跳轉上一頁

###index.php
- require_once "../method/menu.php" 目錄
- if($GET[管理者夾帶得變數])
	- 不同的變數呈現不同的功能頁面
	- 有設定值傳送至 ./setting.php

- else
	- 頁面沒有資料 

###setting.php
- require_once("../method/connect.php");	
- 取得index.php $_GET[海報審核變數]
- 取得index.php $_GET[頁面變數]
- 不同頁面變數處理海報審核變數

##method/
###phpmailer/
phpmailer API 檔案
###connect.php
連線資料庫資訊
###Logout.php
移除session 做登出資料
###menu.php
依$_SESSION[member][level] 呈現不同的目錄
##user/
###index.php
- require_once "../method/menu.php" 目錄
- if($GET[管理者夾帶得變數])
	- 不同的變數呈現不同的功能頁面
	- 有設定值傳送至 ./setting.php

- else
	- 頁面沒有資料 

###add.php
- require_once("../method/connect.php");
- imgurAPI 將海報轉成網址
- 將海報傳至資料庫
- 寄信給管理者
