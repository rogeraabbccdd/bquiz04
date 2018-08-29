<?php
$result = mysqli_query($link, "select user.*, ord.item, ord.time from ord, user where ord.id='".$_GET["id"]."'");
	$row = mysqli_fetch_array($result);
		$i = unserialize($row["item"]);
		?>
		訂單編號<?=$row["time"]?><br>
		姓名<?=$row["name"]?><br>
		帳號<?=$row["acc"]?><br>
		電話<?=$row["tel"]?><br>
		住址<?=$row["adr"]?><br>
		電子信箱<?=$row["mail"]?><br>
		<hr>
		<?php
		itemlist($i, 0);
		?>
		<input type="button" onclick="lof('?redo=order')" value="返回">