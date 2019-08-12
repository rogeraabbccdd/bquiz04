---
description: 編輯使用者管理功能
---

# 使用者管理
編輯使用者管理功能  

## 使用者清單
開新檔 `amem.php`，製作使用者清單    

### 版面製作
在 `amem.php` 製作版面  
```php
會員管理<br>
<?php
	$result = All("select * from user");
	foreach($result as $row)
	{
		?>
		姓名:<?=$row["name"]?><br>
		帳號:<?=$row["acc"]?><br>
		註冊日期:<?=(date("Y/m/d", $row["t"]))?>
		<input type="button" onclick="lof('?redo=editu&id=<?=$row["id"]?>')" value="修改">
		<input type="button" onclick="lof('api.php?do=delu&id=<?=$row["id"]?>')" value="刪除">
		<hr>
		<?php
	}
?>
```
### 處理資料
在 `api.php` 加入處理刪除使用者的程式碼  
```php
case "delu":
    All("delete from user where id = '".$_GET["id"]."'");
    lo("admin.php?redo=mem");
    break;
```

## 修改使用者
開新檔 `aeditu.php`，製作修改使用者資料表單    

### 版面製作
在 `aeditu.php` 製作版面  
直接複製會員註冊頁來修改，把 `form` 的 `action` 改掉就好  
```php
會員修改
<form id="form" method="post" action="api.php?do=editu&id=<?=$_GET["id"]?>">
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
### 處理資料
在 `api.php` 加入修改使用者的程式碼  
```php
case "editu":
    upd("user", $_POST, $_GET["id"], 0);
    lo("admin.php?redo=mem");
    break;
```