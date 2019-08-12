---
description: 編輯商品管理功能
---

# 商品管理
編輯商品管理功能

## 商品清單
開新檔 `aitem.php`，製作商品清單    

### 版面製作
在 `aitem.php` 製作版面  
```php
<a href="?redo=th">商品分類</a>/<a href="?redo=item">商品管理</a><br>
<a href="?redo=nitem">新增商品</a><br>
<?php
	$result = All("select * from item");
	foreach($result as $row)
	{
		?>
		編號:<?=$row["id"]?><br>
		名稱:<?=$row["name"]?><br>
		庫存量:<?=$row["qt"]?><br>
		<?=($row["sell"])?"販售中":"已下架"?><br>
		<input type="button" onclick="lof('?redo=eitem&id=<?=$row["id"]?>')" value="修改">
		<input type="button" onclick="lof('api.php?do=delitem&id=<?=$row["id"]?>')" value="刪除">
		<input type="button" onclick="lof('api.php?do=sell&id=<?=$row["id"]?>')" value="上架">
		<input type="button" onclick="lof('api.php?do=usell&id=<?=$row["id"]?>')" value="下架">
		<hr>
		<?php
	}
?>
```

### 處理資料
在 `api.php` 加入處理表單的程式碼  
```php
// 刪除商品
case "delitem":
    All("delete from item where id = '".$_GET["id"]."'");
    lo("admin.php?redo=item");
    break;

// 上架
case "sell":
    All("update item set sell = 1 where id = '".$_GET["id"]."'");
    lo("admin.php?redo=item");
    break;

// 下架
case "usell":
    All("update item set sell = 0 where id = '".$_GET["id"]."'");
    lo("admin.php?redo=item");
    break;
```

## 新增商品
開新檔 `anitem.php`，製作新增商品表單    

### 版面製作
在 `anitem.php` 製作版面  
```php
新增商品<br>
<form action="api.php?do=nitem" method="post" enctype="multipart/form-data">
所屬大類
<!-- 所屬大類欄位改變時用AJAX獲取中分類 -->
<select name="c1" onchange="getc2()" id="c1">
    <?php
    // 列出所有大類
	$result = All("select * from cat where parent = 0");
	foreach($result as $row)
	{
		?>
		<option value="<?=$row["id"]?>"><?=$row["name"]?></option>
		<?php
	}
	?>
</select><br>
所屬中類<select name="c2" id="c2"></select><br>
商品編號: 完成後自動分配<br>
商品名稱<input type="text" name="name"><br>
商品價格<input type="text" name="price"><br>
規格<input type="text" name="type"><br>
庫存量<input type="text" name="qt"><br>
商品圖片<input type="file" name="file"><br>
商品介紹<textarea name="text"></textarea>
<input type="submit">
<script>
    // 獲取中分類
	function getc2()
	{
        // 取得大分類的值
        var c1 = $("#c1").val();
        // AJAX
		$.post("api.php?do=getc2", {c1}, function(r){
            console.log(r);
            // 把回傳html寫進中分類的 select 標籤裡面
			$("#c2").html(r);
		})
    }
    
    // 頁面載入時先抓中分類
	getc2();
</script>
```

### 處理資料
在 `api.php` 加入處理表單的程式碼  
```php
// 表單獲取中分類
case "getc2":
    $r = "";
    $result = All("select * from cat where parent = '".$_POST["c1"]."'");
    foreach($result as $row)
    {
        $r .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
    }
    echo $r;
    break;

// 新增商品
case "nitem":
    // 上架
    $_POST["sell"] = 1;
    upd("item", $_POST, 0, 1);
    lo("admin.php?redo=nitem");
    break;
```

## 修改商品
開新檔 `aeitem.php`，製作修改商品表單  
直接複製新增商品的表單來改，把 `form` 的 `action` 改掉就好  

### 版面製作
在 `aeitem.php` 製作版面  
```php
修改商品<br>
<form action="api.php?do=eitem&id=<?=$_GET["id"]?>" method="post" enctype="multipart/form-data">
所屬大類
<select name="c1" onchange="c2r()" id="c1">
	<?php
	$result = All("select * from cat where parent = 0");
	foreach($result as $row)
	{
		?>
		<option value="<?=$row["id"]?>"><?=$row["name"]?></option>
		<?php
	}
	?>
</select><br>
所屬中類<select name="c2" id="c2"></select><br>
商品編號: <?=$_GET["id"]?><br>
商品名稱<input type="text" name="name"><br>
商品價格<input type="text" name="price"><br>
規格<input type="text" name="type"><br>
庫存量<input type="text" name="qt"><br>
商品圖片<input type="file" name="file"><br>
商品介紹<textarea name="text"></textarea>
<input type="submit">
<script>
	function c2r()
	{
		var c1 = $("#c1").val();
		$.post("api.php?do=getc2", {c1}, function(r){
			console.log(r);
			$("#c2").html(r);
		})
	}
	c2r();
</script>
```

### 處理表單
在 `api.php` 加入處理表單的程式碼  
```php
case "eitem":
    upd("item", $_POST, $_GET["id"], 0);
    lo("admin.php?redo=ni");
    break;
```