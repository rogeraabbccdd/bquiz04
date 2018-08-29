訂單管理<br>
<?php
	$result = mysqli_query($link, "select ord.*, user.name, user.acc from ord, user");
	while($row = mysqli_fetch_array($result))
	{
		$i = unserialize($row["item"]);
		$m = 0;
		foreach($i as $k => $v)
		{
			$mm = mysqli_fetch_array(mysqli_query($link, "select price from item where id = '".$k."'"))[0];
			$m += $mm;
		}
		?>
		<a href="?redo=vo&id=<?=$row["id"]?>">訂單編號:<?=$row["id"]?></a><br>
		金額:<?=$mm?><br>
		帳號:<?=$row["acc"]?><br>
		姓名:<?=$row["name"]?><br>
		下單時間:<?=(date("Y/m/d", $row["time"]))?><br>
		<input type="button" onclick="lof('api.php?do=delo&id=<?=$row["id"]?>')" value="刪除">
		<hr>
		<?php
	}
?>