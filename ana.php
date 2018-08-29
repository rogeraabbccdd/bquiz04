新增管理帳號<br>
<form action="api.php?do=na" method="post">
帳號<input type="text" name="acc"><br>
密碼<input type="password" name="pw"><br>
<input type="checkbox" name="permit[]" value="0">商品分類與管理<br>
<input type="checkbox" name="permit[]" value="1">訂單管理<br>
<input type="checkbox" name="permit[]" value="2">會員管理<br>
<input type="checkbox" name="permit[]" value="3">頁尾版權區管理<br>
<input type="checkbox" name="permit[]" value="4">最新消息管理<br>
<input type="submit">