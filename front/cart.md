---
description: 編輯購物功能
---

# 購物功能
編輯購物功能

## 購物車頁
開新檔 `buycart.php`，編輯購物車頁面  
```php
<?php
    // 如果沒有session，導向登入頁
	if(empty($_SESSION))	lo("?do=login");
    
    // 如果沒有購物車，也沒有傳商品ID到本頁，顯示沒有商品
	if(empty($_SESSION["cart"]) && empty($_GET["i"]))
		echo "購物車沒有商品";
	
	else
	{
        // 如果有傳商品ID，將傳過來的商品ID和數量加入購物車session
		if(!empty($_GET["i"]))	$_SESSION["cart"][$_GET["i"]] = $_GET["q"];
		// 列出商品
		itemlist($_SESSION["cart"], 1);
		// 顯示按鈕圖片
		echo "<img src='img/0411.jpg' onclick='lof(\"index.php\")'>";
		echo "<img src='img/0412.jpg' onclick='lof(\"?do=out\")'>";
	}
?>
```

## 結帳頁
開新檔 `out.php`，編輯結帳頁  
題目的示意圖有做出編輯會員資料的欄位，但是題目文字只有規定呈現會員帳號而已  
所以就做顯示會員帳號就好  
```php
會員帳號: <?=$_SESSION["acc"]?>
<hr>
<?php
	// 購物車
	itemlist($_SESSION["cart"], 0);
?>
<input type="button" value="確定送出" onclick="lof('api.php?do=chkout')" >
<input type="button" value="返回修改訂單" onclick="lof('?do=buycart')" >
```

## 處理表單資料
在 `api.php` 加入處理表單資料的程式碼
```php
// 刪除購物車商品
case "delcart":
	unset($_SESSION["cart"][$_GET["id"]]);
	lo("index.php?do=buycart");
	break;

// 結帳
case "chkout":
	// 序列化陣列以儲存
	$cart = serialize($_SESSION["cart"]);
	// 目前時間
	$time = strtotime("now");
	$d = array(
		"user" => $_SESSION["id"],
		"item" => $cart,
		"time" => $time
	);
	// 寫入資料庫
	upd("ord", $d, 0, 1);
	// 清空資料庫
	unset($_SESSION["cart"]);
	// 回首頁
	lo("index.php");
	break;
```