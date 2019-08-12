---
description: 編輯商品分類ath.php
---

# 商品分類
編輯商品分類 `ath.php`

## 製作版面
開新檔 `ath.php`，製作商品分類頁版面  
這裡我沒有花時間去排版面，所以用很簡單的方式呈現功能    
```php
<!-- 商品分類和商品管理切換 -->
<a href="?redo=th">商品分類</a>/<a href="?redo=item">商品管理</a><br>
<!--  新增大類表單 -->
<form action="api.php?do=nc1" method="post">新增大類<input type="text" name="c1"><input type="submit"></form>
<!--  新增中類表單 -->
<form action="api.php?do=nc2" method="post">新增中類
    <!--  選擇大類 -->
    <select name="c1">
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
    </select>
    <!--  中類名稱輸入欄位 -->
    <input type="text" name="c2"><input type="submit">
</form>
<!--  編輯分類表單 -->
<form action="api.php?do=ec" method="post">
    <?php
        // 以一個大分類為一區，先查詢所有大分類
        $result = All("select * from cat where parent = 0");
        foreach($result as $row)
        {
            // 直接把分類名稱變成輸入欄位，就省去修改頁
            // checkbox有勾的代表刪除分類，省去按鈕
            // 多一個隱藏欄位傳分類id
            echo "<input type='text' value='".$row["name"]."' name='text[]'>
            <input type='hidden' value='".$row["id"]."' name='id[]'>
            <input type='checkbox' value='".$row["id"]."' name='del[]'><br>";
            
            // 查詢大分類裡的中分類
            $result2 = All("select * from cat where parent = '".$row["id"]."'");
            foreach($result2 as $row2)
            {
                // 直接把分類名稱變成輸入欄位，就省去修改頁
                // checkbox有勾的代表刪除分類，省去按鈕
                // 多一個隱藏欄位傳分類id
                echo 
                "<input type='text' value='".$row2["name"]."' name='text[]'>
                <input type='hidden' value='".$row2["id"]."' name='id[]'>
                <input type='checkbox' value='".$row2["id"]."' name='del[]'><br>";
            }
            
            // 分隔線
            echo "<hr>";
        }
    ?>
    <input type="submit">
</form>
```

## 處理表單
在 `api.php` 加入處理表單的程式碼
```php
// 新增大類
case "nc1":
    All("insert into cat values(null, '".$_POST["c1"]."', 0)");
    lo("admin.php?redo=th");
    break;

// 新增中類
case "nc2":
    All("insert into cat values(null, '".$_POST["c2"]."', '".$_POST["c1"]."')");
    lo("admin.php?redo=th");
    break;

// 修改分類
case "ec":
    // 更新名稱
    for($i=0;$i<count($_POST["id"]);$i++)
    {
        All("update cat set name = '".$_POST["text"][$i]."' where id = '".$_POST["id"][$i]."'");
    }
    // 刪除分類
    foreach($_POST["del"] as $d)
    {
        All("delete from cat where id = '".$d."'");
    }
    lo("admin.php?redo=th");
    break;
```