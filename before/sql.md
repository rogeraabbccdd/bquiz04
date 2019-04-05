---
description: 安裝好XAMPP後，進行SQL資料庫"測試"，將每題的資料表都先建立好，並新增內容
---

# 建立資料庫

這題資料庫沒有需要特別注意的地方，只有電影的資料欄位有點多而已  
這題不用做登入人數，也不需要建立管理員和會員資料庫，因為題目只有一位管理員登入，判斷寫死就好  

## 管理員
新增 `admin` 資料表，儲存管理員資料  
我的權限是設計成陣列，格式為 `$permit[] = 管理項目`  
然後用 `in_array()` 去判斷管理項目有沒有權限  
以下是管理項目對應的編號  

1. 商品分類與管理
2. 訂單管理
3. 會員管理
4. 頁尾版權區管理
5. 最新消息管理

在建立資料表時順便建立預設帳號密碼  
可以先寫個簡單的php來知道序列化後的權限陣列字串  

```php
<?php 
    // 預設帳號的權限
    $permit = array(1,2,3,4,5);
    echo serialize($permit);
?>
```

- `id` 為AUTO\_INCREMENT的流水號
- `acc` 為帳號
- `pw` 為密碼
- `permit` 為管理員權限，將陣列序列化後存入

![資料表結構](../images/sqladmin.png)  
![資料表內容](../images/sqladmin2.png)  

## 商品分類
新增 `cat` 資料表，儲存商品分類  
順便新增好各商品分類  

- `id` 為AUTO\_INCREMENT的流水號
- `name` 為分類名稱
- `parent` 為所屬大分類ID，若為0則是大分類

![資料表結構](../images/sqlcat.png)  
![資料表內容](../images/sqlcat2.png)  

## 頁尾版權
新增 `foot` 資料表，儲存頁尾版權    

- `foot` 為頁尾版權
  
![資料表結構](../images/sqlfoot.png)  
![資料表內容](../images/sqlfoot2.png)  

## 商品
新增 `item` 資料表，儲存商品資料  

- `id` 為AUTO\_INCREMENT的流水號
- `name` 為商品名稱
- `price` 為商品價格
- `file` 為商品圖片
- `c1` 為大類ID
- `c2` 為中類ID
- `qt` 為庫存量
- `type` 為規格
- `text` 為商品說明
- `sell` 為是否上架

![資料表結構](../images/sqlitem.png)  
![資料表內容](../images/sqlitem2.png)  

## 訂單
新增 `ord` 資料表，儲存訂單資料  

- `id` 為AUTO\_INCREMENT的流水號
- `user` 為使用者ID
- `item` 為訂單內容
- `time` 為下訂時間

![資料表結構](../images/sqlord.png)  
![資料表內容](../images/sqlord2.png)  

## 使用者
新增 `user` 資料表，儲存使用者資料  

- `id` 為AUTO\_INCREMENT的流水號
- `acc` 為帳號
- `pw` 為密碼
- `name` 為名稱
- `mail` 為信箱
- `tel` 為電話
- `adr` 為地址
- `t` 為註冊日期

![資料表結構](../images/sqluser.png)  
![資料表內容](../images/sqluser2.png)  
