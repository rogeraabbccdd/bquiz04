<?php
    if(!empty($_GET["i"]))
    {
        $row = All("select * from item where id = '".$_GET["i"]."'")[0];
        $c1 = All("select name from cat where id = '".$row["c1"]."'")[0][0];
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
                <input type="text" name="qt" id="qt"><img src="img/0402.jpg" width="100px" onclick="buy()"><br>
                <hr>
                <script>
                    function buy()
                    {
                        var q = $("#qt").val();
                        var i = <?=$_GET["i"]?>;
                        lof("?do=buycart&i="+i+"&q="+q);
                    }
                </script>
        <?php
    }
    else
    {
        $c = 0;
        if(!empty($_GET["c"])) $c = $_GET["c"];
        if($c == 0)	$result = All("select * from item where sell = 1");
        else
        {
            if(isc1($c))	$result = All("select * from item where sell = 1 and c1 = '".$c."'");
            else	$result = All("select * from item where sell = 1 and c2 = '".$c."'");
        }
        foreach($result as $row)
        {
            ?>
            <a href="?i=<?=$row["id"]?>"><img src="img/<?=$row["file"]?>" width="100px"></a><br>
            編號:<?=$row["id"]?><br>
            商品名稱:<?=$row["name"]?><br>
            價錢:<?=$row["price"]?><br>
            規格:<?=$row["type"]?><br>
            庫存量:<?=$row["qt"]?><br>
            簡介:<?=$row["text"]?><br>
            <a href="?do=buycart&i=<?=$row["id"]?>&q=1"><img src="img/0402.jpg" width="100px"></a><br>
            <hr>
            <?php
        }
    }
?>