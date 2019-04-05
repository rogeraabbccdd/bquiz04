<a href="?redo=th">商品分類</a>/<a href="?redo=item">商品管理</a><br>
<a href="?redo=nitem">新增商品</a><br>
<?php
	$result = All("select * from item");
	foreach($result as $row)
	{
		?>
		編號:<?=$row["id"]?><br>
		名稱:<?=$row["name"]?><br>
		庫存量:<?=$row["qt"]?><br>
		<?=($row["sell"])?"販售中":"已下架"?><br>
		<input type="button" onclick="lof('?redo=eitem&id=<?=$row["id"]?>')" value="修改">
		<input type="button" onclick="lof('api.php?do=delitem&id=<?=$row["id"]?>')" value="刪除">
		<input type="button" onclick="lof('api.php?do=sell&id=<?=$row["id"]?>')" value="上架">
		<input type="button" onclick="lof('api.php?do=usell&id=<?=$row["id"]?>')" value="下架">
		<hr>
		<?php
	}
?>