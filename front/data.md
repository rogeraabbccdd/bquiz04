---
description: 將各頁都會用到的標題資料、校園映像等資料寫進共用檔sql.php。
---

# 編輯共用資料

## 頁尾版權
這題只有頁尾版權在各業會用到  
在共用檔 `sql.php` 寫入頁尾版權的變數
```php
$foot = All("select * from foot")[0][0];
```

## 引用資料庫連接檔
在各頁面加入程式碼，引用資料庫連接檔
```php
include("sql.php");
```

## 寫入頁尾版權
在 `index.php` 和 `admin.php` 找到 `<div id="bottom">`  
加入頁尾版權  
```php
<div id="bottom" style="line-height:70px;background:url(icon/bot.png); color:#FFF;" class="ct">
    頁尾版權 : <?=$foot?>
</div>
```

## 引用jquery
在頁面引用整理檔案時複製過來的jquery  
```html
<script src="./jquery-1.9.1.min.js"></script>
```