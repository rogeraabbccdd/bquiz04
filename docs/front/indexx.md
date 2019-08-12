---
description: 編輯首頁index.php
---

# 首頁
編輯首頁 `index.php`  

## 調整版面和導覽列
標題圖片太大造成版面撐開，超過規定的 `1024x768`，所以稍微調整一下標題的版面  
找到 `<div id="top">`，修改 `img` 的大小並將導覽列靠右  
導覽列的會員登入加入判斷是否有登入的程式碼，有登入則改為顯示登出  
導覽列的管理登入的 `do` 改成 `ain`，避免和管理頁 `admin.php` 衝突  
最後在跑馬燈區加上 `marquee` 標籤  
```php
<div id="top">
    <a href="?">
        <img src="./home_files/0416.jpg" width="300px">
    </a>
    <div style="padding:10px; float:right">
        <a href="?">回首頁</a> |
        <a href="?do=news">最新消息</a> |
        <a href="?do=look">購物流程</a> |
        <a href="?do=buycart">購物車</a> |
        <a href="<?=(empty($_SESSION))?"?do=login":"api.php?do=out"?>"><?=(empty($_SESSION))?"會員登入":"登出"?></a> |
        <a href="?do=ain">管理登入</a>
    </div>
    <marquee>情人節特惠活動 &nbsp; 為了慶祝七夕情人節，將舉辦情人兩人到現場有七七折之特惠活動~ </marquee>
</div>
```

## 商品分類區
找到左側欄 `<div id="left" class="ct">` 裡面的 `<div style="min-height:400px;">`  
加入查詢分類的程式碼  
大分類必須要設定class為 `ww`，裡面包中分類，中分類的class必須設為 `s` 才能套用版型動畫  
```php
<!-- 全部商品 -->
<div class='ww'><a href='?c=0'>全部商品(<?=( count( All("select * from item where sell = 1") ))?>)</a></div>
<?php
    // 大分類
    $result = All("select * from cat where parent = 0");
    foreach($result as $row)
    {
            // 大分類商品數
            $c = count(All("select * from item where c1 = '".$row["id"]."'"));

            // 大分類div、大分類名稱和商品數
            echo "<div class='ww'><a href='?c=".$row["id"]."'>".$row["name"]."(".$c.")</a>";
            
            // 查詢大分類裡的中分類
            $result2 = All("select * from cat where parent = '".$row["id"]."'");
            foreach($result2 as $row2)
            {
                // 中分類商品數
                $cc = count(All("select * from item where c2 = '".$row2["id"]."'"));

                // 中分類div
                echo "<div class='s'><a href='?c=".$row2["id"]."'>".$row2["name"]."(".$cc.")</div></a>";
            }

            // 大分類div的結尾
            echo "</div>";
    }
?>
```

## 內容區
找到內容區 `<div id="right">`，加入顯示內容的程式碼  
設定 `overflow-y:scroll; height:500px` 避免內容過長造成高度跑版  
```php
<div id="right" style="overflow-y:scroll; height:500px">
    <?php
        // 預設載入商品列表main.php
        $p = "main";
        // 如果有do，則載入do變數檔名的php
        if(!empty($_GET["do"]))	$p = $_GET["do"];
        // 如果是購物流程，直接顯示圖片
        if($p == "look")	echo "<img src='img/0401.jpg'>";
        // 如果是最新消息，直接顯示兩則最新消息的標題
        elseif($p == "news") echo "最新消息<br>年終特賣會開跑了<br>情人節特惠活動";
        else include($p.".php");
    ?>
 </div>
```