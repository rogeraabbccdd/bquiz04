<h1>填寫資料</h1>
<form id="out" method="post">
    <table>
        <tr>
            <td>登入帳號</td>
            <td><input type="text" name="user" value="<?=$_SESSION["user"]?>"></td>
        </tr>
        <tr>
            <td>姓名</td>
            <td><input type="text" name="name" value="<?=$_SESSION["name"]?>"></td>
        </tr>
        <tr>
            <td>電子信箱</td>
            <td><input type="text" name="mail" value="<?=$_SESSION["mail"]?>"></td>
        </tr>
        <tr>
            <td>聯絡地址</td>
            <td><input type="text" name="adr" value="<?=$_SESSION["adr"]?>"></td>
        </tr>
        <tr>
            <td>聯絡電話</td>
            <td><input type="text" name="tel" value="<?=$_SESSION["tel"]?>"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>編號</td>
            <td>商品名稱</td>
            <td>數量</td>
            <td>單價</td>
            <td>小計</td>
        </tr>
        <?php
			$total = 0;
            for($i =0; $i<count($_SESSION["i"]); $i++)
            {
                $result = mysqli_query($link, "select * from item where id = '".$_SESSION["i"][$i]."'");
                $row = mysqli_fetch_array($result);
                $price2 = $row["price"]*$_SESSION["qt"][$i];
                $total += $price2;
                ?>
                    <tr id="cart<?=$i?>">
                        <td><?=$row["id"]?></td>
                        <td><?=$row["name"]?></td>
                        <td><?=$_SESSION["qt"][$i]?></td>
                        <td><?=$row["price"]?></td>
                        <td><?=$price2?></td>
                    </tr>
                <?php
            }
        ?>
        <tr><td colspan="5">總價:<?=$total?></td></tr>
    </table>
    <input type="submit" value="確定送出">
    <input type="button" value="返回修改訂單" onclick="lof('index.php?do=buycart')">
</form>
<script>
    $("#out").on("submit", function(e){
        e.preventDefault();
        $.post("api.php?do=out", $(this).serialize(), function(r){
            alert("訂購成功\n感謝您的選購")
        })
    })
</script>