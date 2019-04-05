會員管理<br>
<?php
	$result = All("select * from user");
	foreach($result as $row)
	{
		?>
		姓名:<?=$row["name"]?><br>
		帳號:<?=$row["acc"]?><br>
		註冊日期:<?=(date("Y/m/d", $row["t"]))?>
		<input type="button" onclick="lof('?redo=editu&id=<?=$row["id"]?>')" value="修改">
		<input type="button" onclick="lof('api.php?do=delu&id=<?=$row["id"]?>')" value="刪除">
		<hr>
		<?php
	}
?>