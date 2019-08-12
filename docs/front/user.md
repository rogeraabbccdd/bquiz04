---
description: 編輯使用者登入註冊功能
---

# 使用者
編輯使用者登入註冊功能

## 登入頁
開新檔 `login.php` 做登入頁
```php
<?php
    // 產生驗證碼
	$n = getnums();
?>
第一次購物<br>
<a href="?do=reg"><img src="img/0413.jpg"></a><br>
會員登入<br>
<form id="in" action="api.php?do=in" method="post">
帳號<input type="text" name="acc"><br>
密碼<input type="password" name="pw"><br>
<?=($n[0]."+".$n[1]."=")?><input type="text" name="num" id="num">
<input type="button" id="btn" value="登入">
<script>
// 點登入按鈕時
$("#btn").on("click", function(e){
    // 檢查驗證碼是否正確，正確的話送出表單
    if($("#num").val() != <?=$n[2]?>)	alert("驗證碼錯誤");
	else $("#in").submit();
})
</script>
```

## 註冊頁
開新檔 `reg.php` 做登入頁  
```html
會員註冊
<form id="form" method="post" action="api.php?do=reg">
姓名<input type="text" name="name"><br>
帳號<input type="text" name="acc" id="a"><input type="button" value="檢測帳號" onclick="chk(0)"><br>
密碼<input type="password" name="pw"><br>
電話<input type="text" name="tel"><br>
住址<input type="text" name="adr"><br>
電子信箱<input type="text" name="mail"><br>
<input type="button" value="送出" onclick="chk(1)">
<script>
	function chk(submit)
	{
        // 獲取帳號欄位的值
        var a = $("#a").val();
        // 如果帳號輸入admin，直接跳出訊息
        if(a == "admin")	alert("無法使用admin當帳號");
        // 如果不是，檢查帳號
		else
		{
            // 使用ajax向api.php要資料
			$.post("api.php?do=chk", {a}, function(r){
                // 如果回傳ok
				if(r == "ok")
				{
                    // 如果submit為1，送出註冊表單
                    if(submit)	$("#form").submit();
                    // 如果為0，只是單純的檢查帳號
					else alert("帳號可以使用");
				}
				else alert("帳號無法使用");
			})	
		}
	}
</script>
```

## 處理表單資料
開新檔 `api.php` ，寫入處理表單資料的程式碼    
```php
<?php
    // 引用function
    include("sql.php");
    
    // 以 $_GET["do"] 來判斷要執行什麼動作
	switch($_GET["do"])
	{
        // 登入
        case "in":
            // 查詢是否有這個帳號
			$result = All("select * from user where acc = '".$_POST["acc"]."' and pw = '".$_POST["pw"]."' ");
			$num = count($result);
            
            // 如果有
			if($num > 0) 
			{
                // 直接把所有欄位資料放入session
				$_SESSION = $result[0];
				lo("index.php");
            }
            // 沒有的話則跳出訊息並回登入頁
			else echo "<script>alert('帳號或密碼錯誤'); window.location='index.php?do=login';</script>";
			break;
        
        // 檢查帳號
        case "chk":
            // 查詢是否有這個帳號
			$num = count(All("select * from user where acc = '".$_POST["a"]."'"));
			if($num > 0) echo "x";
			else echo "ok";
			break;
        
        // 註冊
		case "reg":
			$_POST["t"] = strtotime("now");
			upd("user", $_POST, 0, 1);
			lo("index.php?do=login");
			break;
        
        // 登出
		case "out":
			session_unset();
			session_destroy();
			lo("index.php");
            break;
    }
?>
```