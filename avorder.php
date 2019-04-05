<?php
    $row = All("select user.*, ord.item, ord.time from ord, user where ord.id='".$_GET["id"]."'")[0];
    $item = unserialize($row["item"]);
    $id = date("YmdHis",$row["time"]);
?>
訂單編號<?=$id?><br>
姓名<?=$row["name"]?><br>
帳號<?=$row["acc"]?><br>
電話<?=$row["tel"]?><br>
住址<?=$row["adr"]?><br>
電子信箱<?=$row["mail"]?><br>
<hr>
<?php
    itemlist($item, 0);
?>  
<a href="?redo=order">返回</a>