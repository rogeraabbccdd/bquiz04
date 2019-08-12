---
description: 編輯管理登入頁ain.php
---

# 管理登入頁
編輯管理登入頁 `ain.php`  

## 登入表單
直接複製會員登入頁 `login.php` 的內容來修改  
把 `第一次購物` 區刪除，把字改成 `管理登入`，修改 `form` 標籤的 `action`  
```php
<?php
	$n = getnums();
?>
管理登入<br>
<form id="in" action="api.php?do=ain" method="post">
帳號<input type="text" name="acc"><br>
密碼<input type="password" name="pw"><br>
<?=($n[0]."+".$n[1]."=")?><input type="text" name="num" id="num">
<input type="button" id="btn" value="登入">
<script>
$("#btn").on("click", function(e){
	if($("#num").val() != <?=$n[2]?>)	alert("驗證碼錯誤");
	else $("#in").submit();
})
</script>
```

## 處理表單
在 `api.php` 寫入處理管理登入的程式碼  
直接複製會員登入來修改比較省時  
```php
case "ain":
    // 是否有這個帳號
    $row = All("select * from admin where acc = '".$_POST["acc"]."' and pw = '".$_POST["pw"]."'")[0];
    $num = count($row);
    if($num > 0) 
    {
        // 設定session id為管理者id
        $_SESSION["id"] = $row["id"];
        // 權限
        $_SESSION["permit"] = unserialize($row["permit"]);
        // 導向管理頁
        lo("admin.php");
    }
    else echo "<script>alert('帳號或密碼錯誤'); window.location='index.php?do=ain';</script>";
    break;
```