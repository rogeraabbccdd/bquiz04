會員管理<br>
<?php
	$result = mysqli_query($link, "select * from user");
	while($row = mysqli_fetch_array($result))
	{
		?>
		姓名:<?=$row["name"]?><br>
		帳號:<?=$row["acc"]?><br>
		註冊日期:<?=(date("Y/m/d", $row["t"]))?>
		<input type="button" onclick="lof('?redo=em&id=<?=$row["id"]?>')" value="修改">
		<input type="button" onclick="lof('api.php?do=delm&id=<?=$row["id"]?>')" value="刪除">
		<hr>
		<?php
	}
?>