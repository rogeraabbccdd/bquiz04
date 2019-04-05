---
description: 編輯商品頁main.php
---

# 商品頁
新增商品頁 `main.php`，編輯內容  

## 顯示商品
以 `$_GET["i"]` 來判斷有沒有指定特定商品  
以 `$_GET["c"]` 來判斷有沒有指定特定分類  
建議不要花時間做像示意圖中的表格，第四題量很多，不要花時間在版面上  
用 `hr` 分隔每樣商品就好  
```php
<?php
    // 如果有指定商品，顯示商品介紹
    if(!empty($_GET["i"]))
    {
        // 查詢商品資料
        $row = All("select * from item where id = '".$_GET["i"]."'")[0];
        // 查詢大分類名稱
        $c1 = All("select name from cat where id = '".$row["c1"]."'")[0][0];
        // 查詢中分類名稱
        $c2 = All("select name from cat where id = '".$row["c2"]."'")[0][0];
        ?>
            <img src="img/<?=$row["file"]?>" width="100px"><br>
            分類:<?=$c1.">".$c2?>
            編號:<?=$row["id"]?><br>
            商品名稱:<?=$row["name"]?><br>
            價錢:<?=$row["price"]?><br>
            規格:<?=$row["type"]?><br>
            庫存量:<?=$row["qt"]?><br>
            簡介:<?=$row["text"]?><br>
            <!-- 購買按鈕 -->
            <input type="text" name="qt" id="qt"><img src="img/0402.jpg" width="100px" onclick="buy()"><br>
            <hr>
            <script>
                // 購買按鈕的function
                function buy()
                {
                    // 購買數量
                    var q = $("#qt").val();
                    // 商品id
                    var i = <?=$_GET["i"]?>;
                    // 導向購物頁面
                    // lof為版型內建跳頁function
                    lof("?do=buycart&i="+i+"&q="+q);
                }
            </script>
        <?php
    }
    else
    {
        // 預設全部顯示
        $c = 0;
        // 如果有指定分類的話，顯示指定分類商品
        if(!empty($_GET["c"])) $c = $_GET["c"];
        // 如果沒分類指定，查詢所有商品
        if($c == 0)	$result = All("select * from item where sell = 1");
        // 如果有指定分類
        else
        {
            // 如果該分類ID為大分類，查詢大分類所有商品
            if(isc1($c))	$result = All("select * from item where sell = 1 and c1 = '".$c."'");
            // 如果該分類ID為中分類，查詢中分類所有商品
            else	$result = All("select * from item where sell = 1 and c2 = '".$c."'");
        }
        // 列出商品
        foreach($result as $row)
        {
            ?>
                <!-- 點商品圖進入商品介紹 -->
                <a href="?i=<?=$row["id"]?>"><img src="img/<?=$row["file"]?>" width="100px"></a><br>
                編號:<?=$row["id"]?><br>
                商品名稱:<?=$row["name"]?><br>
                價錢:<?=$row["price"]?><br>
                規格:<?=$row["type"]?><br>
                庫存量:<?=$row["qt"]?><br>
                簡介:<?=$row["text"]?><br>
                 <!-- 點購買按鈕導到購買頁，直接指定數量為1 -->
                <a href="?do=buycart&i=<?=$row["id"]?>&q=1"><img src="img/0402.jpg" width="100px"></a><br>
                <hr>
            <?php
        }
    }
?>
```