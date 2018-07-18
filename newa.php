<h1>新增管理帳號</h1>
<form id="newa" method="post" action="api.php?do=newa">
    <table>
        <tr>
            <td>帳號</td>
            <td><input type="text" name="acc"></td>
        </tr>
        <tr>
            <td>密碼</td>
            <td><input type="text" name="pw"></td>
        </tr>
        <tr>
            <td>權限</td>
            <td>
                <input type="checkbox" name="permit[]" value="0">商品分類與管理<br>
                <input type="checkbox" name="permit[]" value="1">訂單管理<br>
                <input type="checkbox" name="permit[]" value="2">會員管理<br>
                <input type="checkbox" name="permit[]" value="3">頁尾版權區管理<br>
                <input type="checkbox" name="permit[]" value="4">最新消息管理<br>
            </td>
        </tr>
    </table>
    <input type="submit">
    <input type="reset">
</form>