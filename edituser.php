<?php
	$result = mysqli_query($link, "select * from user where id = '".$_GET["id"]."'");
	$row = mysqli_fetch_array($result);
?>
<h1>編輯會員資料</h1>
<form action="api.php?do=edituser&id=<?=$_GET["id"]?>" method="post">
<table>
	<tr>
		<td>帳號</td>
		<td><?=$row["acc"]?></td>
	</tr>
	<tr>
		<td>姓名</td>
		<td><input type="text" value="<?=$row["name"]?>" name="name"></td>
	</tr>
	<tr>
		<td>電子信箱</td>
		<td><input type="text" value="<?=$row["mail"]?>" name="mail"></td>
	</tr>
	<tr>
		<td>地址</td>
		<td><input type="text" value="<?=$row["adr"]?>" name="adr"></td>
	</tr>
	<tr>
		<td>電話</td>
		<td><input type="text" value="<?=$row["tel"]?>" name="tel"></td>
	</tr>
</table>
<input type="submit" value="編輯">
<input type="reset">
<input type="button" onclick="window.history.back()" value="取消">
</form>