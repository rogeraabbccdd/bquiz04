---
description: 編輯管理權限設置
---

# 管理權限設置
編輯管理權限設置功能  

## 管理員列表
新增 `aadmin.php`，顯示管理員列表  
以 `hr` 分隔各項目，就不需要花時間用 `tr` 和 `td` 排表格  
```php
<a href="?redo=nadmin">新增管理員</a><br>
<?php
	$result = All("select * from admin");
	foreach($result as $row)
	{
		echo "
		帳號".$row["acc"]."<br>
        密碼".$row["pw"]."<br>";
        // 管理員ID為1代表是預設帳號，不能修改
		if($row["id"] != 1)
		{
			echo "
                <input type='button' value='修改' onclick='lof(\"?redo=eadmin&id=".$row["id"]."\")'>
                <input type='button' value='刪除' onclick='lof(\"api.php?do=deladmin&id=".$row["id"]."\")'>
                ";
		}
		else echo "此為最高管理權限帳號";
		echo "<hr>";
	}
?>
```

## 修改管理員
新增 `aeadmin.php`，製作修改管理員表單   
以 `$_GET["id]` 來判斷修改哪位管理員  
直接用空白表單，省去從資料庫取值得時間  
```php
修改管理帳號<br>
<form action="api.php?do=ea&id=<?=$_GET["id"]?>" method="post">
帳號<input type="text" name="acc"><br>
密碼<input type="password" name="pw"><br>
<input type="checkbox" name="permit[]" value="1">商品分類與管理<br>
<input type="checkbox" name="permit[]" value="2">訂單管理<br>
<input type="checkbox" name="permit[]" value="3">會員管理<br>
<input type="checkbox" name="permit[]" value="4">頁尾版權區管理<br>
<input type="checkbox" name="permit[]" value="5">最新消息管理<br>
<input type="submit">
```

## 新增管理員
新增 `anadmin.php`，製作新增管理員表單   
直接複製修改管理員的表單來改，把 `form` 的 `action` 改掉就好  
```html
新增管理帳號<br>
<form action="api.php?do=nadmin" method="post">
帳號<input type="text" name="acc"><br>
密碼<input type="password" name="pw"><br>
<input type="checkbox" name="permit[]" value="1">商品分類與管理<br>
<input type="checkbox" name="permit[]" value="2">訂單管理<br>
<input type="checkbox" name="permit[]" value="3">會員管理<br>
<input type="checkbox" name="permit[]" value="4">頁尾版權區管理<br>
<input type="checkbox" name="permit[]" value="5">最新消息管理<br>
<input type="submit">
```

## 處理表單資料
在 `api.php` 裡加入處理表單資料的程式碼
```php
// 編輯管理員
case "eadmin":
    $_POST["permit"] = serialize($_POST["permit"]);
    upd("admin", $_POST, $_GET["id"], 0);
    lo("admin.php?redo=admin");
    break;

// 新增管理員
case "nadmin":
    $_POST["permit"] = serialize($_POST["permit"]);
    upd("admin", $_POST, 0, 1);
    lo("admin.php?redo=admin");
    break;

// 刪除管理員
case "deladmin":
    All("delete from admin where id = '".$_GET["id"]."'");
    lo("admin.php?redo=admin");
    break;
```