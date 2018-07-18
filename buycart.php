<?php
    if(empty($_SESSION["user"]))	header("location:index.php?do=login");
    
    if(!empty($_GET["id"]))
    {
        if(empty($_SESSION["i"]))
        {
            $_SESSION["i"][] = $_GET["id"];
            
            if(!empty($_GET["qt"]))  $_SESSION["qt"][] = $_GET["qt"];
            else $_SESSION["qt"][] = 1;
        }
        else
        {
            if(!in_array($_GET["id"], $_SESSION["i"]))
            {
                $_SESSION["i"][] = $_GET["id"];
                
                if(!empty($_GET["qt"]))  $_SESSION["qt"][] = $_GET["qt"];
                else $_SESSION["qt"][] = 1;
            }
        }
    }

    if(empty($_SESSION["i"]))    echo "<h1>空的購物車，請先選購商品</h1>";
    else
    {
        ?>
    <h1><?=$_SESSION["name"]?>的購物車</h1>
    <table>
        <tr>
            <td>編號</td>
            <td>商品名稱</td>
            <td>數量</td>
            <td>庫存量</td>
            <td>單價</td>
            <td>小計</td>
            <td>刪除</td>
        </tr>
        <?php
            for($i =0; $i<count($_SESSION["i"]); $i++)
            {
                $result = mysqli_query($link, "select * from item where id = '".$_SESSION["i"][$i]."'");
                $row = mysqli_fetch_array($result);
                ?>
                    <tr id="cart<?=$i?>">
                        <td><?=$row["id"]?></td>
                        <td><?=$row["name"]?></td>
                        <td><input type="text" value="<?=$_SESSION["qt"][$i]?>" onchange="updateqt('<?=$i?>')" id="qt<?=$i?>"></td>
                        <td id="tqt<?=$i?>"><?=$row["qt"]?></td>
                        <td><?=$row["price"]?></td>
                        <td><?php  echo $row["price"]*$_SESSION["qt"][$i]; ?></td>
                        <td><img src="images/0415.jpg" onclick="delcart(<?=$i?>)"></td>
                    </tr>
                <?php
            }
        ?>
    </table>
    <img src="images/0411.jpg" onclick="lof('index.php')">&emsp;<img src="images/0412.jpg" onclick="lof('index.php?do=out')">
<?php
    }
?>
<script>
    function delcart(i)
    {
        $.post("api.php?do=delcart", {i}, function(r){
            $("#cart"+i).remove();
        })
    }
    function updateqt(i)
    {
        var qt = $("#qt"+i).val();
        var tqt = $("#tqt"+i).text();
        if(qt > tqt)   alert("庫存不足");
        else    $.post("api.php?do=qt", {qt, i});
    }
</script>