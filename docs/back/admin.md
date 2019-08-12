---
description: 編輯管理頁admin.php
---

# 管理頁
編輯管理頁 `admin.php`

## 調整版面和導覽列
標題圖片太大造成版面撐開，超過規定的 `1024x768`，所以稍微調整一下標題的版面  
找到 `<div id="top">`，修改 `img` 的大小  

```html
<div id="top">
    <a href="?">
        <img src="./Manage Page_files/0416.jpg" height="50px">
    </a>
    <img src="./Manage Page_files/0417.jpg" height="50px">
</div>
```

## 管理功能選單
修改管理功能選單，變成有權限才能看到選單項目  
找到 `<div id="left" class="ct">`，修改裡面的內容  
```php
<div style="min-height:400px;">
    <!-- 直接寫死成管理員ID為1的預設管理員才能看到 -->
    <?=($_SESSION["id"] == 1)?"<a href='?do=admin&redo=admin'>管理權限設置</a>":""?>
    <!-- 有權限才顯示 -->
    <?=(in_array(1, $_SESSION["permit"]))?"<a href='?do=admin&redo=th'>商品分類與管理</a>":""?>
    <?=(in_array(2, $_SESSION["permit"]))?"<a href='?do=admin&redo=order'>訂單管理</a>":""?>
    <?=(in_array(3, $_SESSION["permit"]))?"<a href='?do=admin&redo=mem'>會員管理</a>":""?>
    <?=(in_array(4, $_SESSION["permit"]))?"<a href='?do=admin&redo=bot'>頁尾版權管理</a>":""?>
    <?=(in_array(5, $_SESSION["permit"]))?"<a href='?do=admin&redo=news'>最新消息管理</a>":""?>
    <!-- 修改連結到api.php的登出 -->
    <a href="api.php?do=out" style="color:#f00;">登出</a>
 </div>
```

## 內容區
找到 `<div id="right>`，修改裡面內容  
```php
<div id="right"  style="overflow-y:scroll; height:500px">
    <?php
        // 題目已經寫好redo了，所以如果有redo就引用a開頭接redo為檔名的php
        // a開頭的原因是避免和前台頁面衝突
        if(!empty($_GET["redo"]))   include("a".$_GET["redo"].".php");
        // 沒redo的話顯示文字
        else echo "請選擇管理項目";
    ?>
 </div>
```
