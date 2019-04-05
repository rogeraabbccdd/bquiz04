---
description: 編輯頁尾版權管理
---

# 頁尾版權管理
編輯頁尾版權管理功能  

## 頁尾版權
開新檔 `abot.php`，製作頁尾版權表單
```html
頁尾版權
<form method="post" action="api.php?do=foot">
<input type="text" name="foot"><br>
<input type="submit" value="編輯">
<input type="reset" value="重置">
```

## 處理表單資料
在 `api.php` 裡加入處理表單資料的程式碼
```php
case "foot":
    All("update foot set foot = '".$_POST["foot"]."'");
    lo("admin.php?redo=bot");
    break;
```