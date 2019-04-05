---
description: SQL資料庫"測試"完成後，開始"測試"PHP，寫好共用function以及資料庫連接、session等程式碼
---

# 編寫共用程式碼

## 建立檔案sql.php

建立檔案sql.php，放入共用程式碼

## 寫入必要程式碼

```php
// 開啟資料庫連接
$pdo = new PDO("mysql:host=localhost;dbname=dbxx;charset=utf8", "root", "");
// session
session_start();
```

## 寫入function

由於考試有四個小時的時間限制，將一些常用語法寫成 function 來縮短字數，節省打字時間  
```php
// 節省 fetchAll 字數
// 只寫fetchAll就夠了，因為fetchAll有含query，所以更新和刪除資料也能用
function All($sql)
{
	global $pdo;
	return $pdo->query($sql)->fetchAll();
}

// 節省 header跳頁 字數
// 其他題版型自訂的Javascript跳頁函式名稱也叫lo
function lo($l)
{
	return header("location:".$l);
}

// 判斷分類ID是否為大分類
function isc1($c)
{
	global $link;
	$cc = All("select parent from cat where id = '".$c."'")[0][0];
	if($cc == 0)	return true;
	else return false;
}

// 產生驗證碼
// 將兩個數字和相加結果以陣列回傳
function getnums()
{
	$n1 = rand(10, 99);
	$n2 = rand(10, 99);
	$n3 = $n1 + $n2;
	$r = array($n1, $n2, $n3);
	return $r;
}

// 更新或新增資料
// 這題表單結構比第一題簡單，所以可以先寫
// $table 為資料表
// $data 為 $_POST
// $id 為資料ID
// $insert 為是否新增資料
function upd($table, $data, $id, $insert)
{
	global $pdo;
	// 如果是新增資料，新增一筆後取得新資料的ID
	if($insert)	
	{
		All("insert into ".$table." (id) values (null)");
		$id = $pdo->lastInsertId();
	}
	// 迴圈 $_POST 資料，一個一個 update
	// 所以 input 的 name 要跟資料表欄位一樣
	foreach($data as $key=>$value)
	{
		All("update ".$table." set ".$key." = '".$value."' where id = '".$id."'");
	}

	// 如果有上傳檔案
	if(!empty($_FILES["file"]))
	{
		// 以時間當檔名
		$time = strtotime("now");
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$fn = $time.".".$ext;
		// 移動到圖片資料夾
		copy($_FILES["file"]["tmp_name"], "img/".$fn);
		// 寫入資料庫
		All("update ".$table." set file = '".$fn."' where id = '".$id."'");
	}
}

// 商品清單
// 這題蠻多地方會需要列出商品清單，所以寫成 function
// $data 為商品陣列，陣列格式設計為 $data[商品ID] = 數量
// $del 為是否顯示刪除按鈕，只有前台會用到
function itemlist($data, $del)
{
	// 總金額
	$totalmoney = 0;
	foreach($data as $k=> $v)
	{
		$row =  All("select * from item where id = '".$k."'")[0];
		$money = $v*$row["price"];
		$totalmoney += $money;
		echo "
		編號:".$row["id"]."<br>
		商品名稱:".$row["name"]."<br>
		數量:".$v."<br>
		庫存量:".$row["qt"]."<br>
		單價:".$row["price"]."<br>
		小計:".$money."<br>";
		
		if($del) echo "<input type='button' value='刪除' onclick='lof(\"api.php?do=delcart&id=".$k."\")'>";
		
		echo "<hr>";
	}
	echo "總金額:".$totalmoney;
}

// 顯示使用者資料
// 這題蠻多地方會需要顯示使用者資料，所以寫成 function
// $user 為使用者ID
function userdata($user)
{
	$row = All("select * from user where id = '".$user."'")[0];
	echo "
		姓名:".$row["name"]."<br>
		帳號:".$row["acc"]."<br>
		電話:".$row["tel"]."<br>
		住址:".$row["adr"]."<br>
		電子信箱:".$row["mail"]."<br>
		<hr>";
}
```
