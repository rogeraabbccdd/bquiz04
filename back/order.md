---
description: 編輯訂單管理功能
---

# 訂單管理
編輯訂單管理功能  
題目規定訂單編號前8位為日期，後六位自訂，用年月日時分秒數字剛好符合要求  

## 訂單清單
開新檔 `aorder.php`，製作訂單清單    

### 版面製作
在 `aorder.php` 製作版面  
```php
訂單管理<br>
<?php
    // 查詢訂單和使用者資訊
	$result = All("select ord.*, user.name, user.acc from ord, user where user.id = ord.user");
	foreach($result as $row)
	{
        // 下訂商品
        $item = unserialize($row["item"]);
        // 計算總金額
        $money = 0;
        // 訂單編號為日期數字
        $id = date("YmdHis",$row["time"]);
        // 查詢各商品的價格，計算總金額
		foreach($item as $k => $v)
		{
			$m = All("select price from item where id = '".$k."'")[0][0];
			$money += $m;
		}
		?>
		<a href="?redo=vorder&id=<?=$row["id"]?>">訂單編號:<?=$id?></a><br>
		金額:<?=$money?><br>
		帳號:<?=$row["acc"]?><br>
		姓名:<?=$row["name"]?><br>
		下單時間:<?=(date("Y/m/d", $row["time"]))?><br>
		<input type="button" onclick="lof('api.php?do=delorder&id=<?=$row["id"]?>')" value="刪除">
		<hr>
		<?php
	}
?>
```

### 處理資料
在 `api.php` 加入處理刪除訂單的程式碼  
```php
case "delorder":
    All("delete from ord where id = '".$_GET["id"]."'");
    lo("admin.php?redo=order");
    break;
```

## 訂單資料
開新檔 `avorder.php`，製作定訂單詳細資料頁      

### 版面製作
在 `avorder.php` 製作版面  
```php
<?php
    // 查詢訂單和使用者資訊
    $row = All("select user.*, ord.item, ord.time from ord, user where ord.id='".$_GET["id"]."'")[0];
    // 下訂商品
    $item = unserialize($row["item"]);
    // 訂單編號為日期數字
    $id = date("YmdHis",$row["time"]);
?>
訂單編號<?=$id?><br>
姓名<?=$row["name"]?><br>
帳號<?=$row["acc"]?><br>
電話<?=$row["tel"]?><br>
住址<?=$row["adr"]?><br>
電子信箱<?=$row["mail"]?><br>
<hr>
<?php
    itemlist($item, 0);
?>  
<a href="?redo=order">返回</a>
```