訂單管理<br>
<?php
	$result = All("select ord.*, user.name, user.acc from ord, user where user.id = ord.user");
	foreach($result as $row)
	{
		$item = unserialize($row["item"]);
        $money = 0;
        $id = date("YmdHis",$row["time"]);
		foreach($item as $k => $v)
		{
			$m = All("select price from item where id = '".$k."'")[0][0];
			$money += $m;
		}
		?>
		<a href="?redo=vorder&id=<?=$row["id"]?>">訂單編號:<?=$id?></a><br>
		金額:<?=$money?><br>
		帳號:<?=$row["acc"]?><br>
		姓名:<?=$row["name"]?><br>
		下單時間:<?=(date("Y/m/d", $row["time"]))?><br>
		<input type="button" onclick="lof('api.php?do=delorder&id=<?=$row["id"]?>')" value="刪除">
		<hr>
		<?php
	}
?>