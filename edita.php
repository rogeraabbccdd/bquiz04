<h1>修改管理員權限</h1>
<form id="edit" method="post" action="api.php?do=edita">
<?php
    $result = mysqli_query($link, "select * from admin where id = '".$_GET["id"]."'");
    $row = mysqli_fetch_array($result);
    $pw = $row["pw"];
    $acc = $row["acc"];
    $p = str_split($row["permit"]);
?>
    <table>
        <tr>
            <td>帳號</td>
            <td><input type="text" name="acc" value="<?=$acc?>"></td>
        </tr>
        <tr>
            <td>密碼</td>
            <td><input type="text" name="pw" value="<?=$pw?>"></td>
        </tr>
        <tr>
            <td>權限</td>
            <td>
                <input type="checkbox" name="permit[]" value="0" <?=($p[0] == "1")?"checked":"";?>>商品分類與管理<br>
                <input type="checkbox" name="permit[]" value="1" <?=($p[1] == "1")?"checked":"";?>>訂單管理<br>
                <input type="checkbox" name="permit[]" value="2" <?=($p[2] == "1")?"checked":"";?>>會員管理<br>
                <input type="checkbox" name="permit[]" value="3" <?=($p[3] == "1")?"checked":"";?>>頁尾版權區管理<br>
                <input type="checkbox" name="permit[]" value="4" <?=($p[4] == "1")?"checked":"";?>>最新消息管理<br>
            </td>
        </tr>
    </table>
    <input type="hidden" name="id" value="<?=$_GET["id"]?>">
    <input type="submit">
    <input type="reset">
</form>