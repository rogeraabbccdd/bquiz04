<a href="?redo=ni">新增商品</a><br>
<?php
	$result = mysqli_query($link, "select * from item");
	while($row = mysqli_fetch_array($result))
	{
		?>
		編號:<?=$row["id"]?><br>
		名稱:<?=$row["name"]?><br>
		庫存量:<?=$row["qt"]?><br>
		<?=($row["sell"])?"販售中":"已下架"?><br>
		<input type="button" onclick="lof('?redo=eii&id=<?=$row["id"]?>')" value="修改">
		<input type="button" onclick="lof('api.php?do=deli&id=<?=$row["id"]?>')" value="刪除">
		<input type="button" onclick="lof('api.php?do=s&id=<?=$row["id"]?>')" value="上架">
		<input type="button" onclick="lof('api.php?do=us&id=<?=$row["id"]?>')" value="下架">
		<hr>
		<?php
	}
?>