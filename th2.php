<h2><a href="?do=th">商品分類</a> / <a href="?do=th2">商品管理</a></h2>
<h1>商品管理</h1>
<input type="button" onclick="lof('?do=newi')" value="新增商品">
<table>
	<tr>
		<td>編號</td>
		<td>商品名稱</td>
		<td>庫存量</td>
		<td>狀態</td>
		<td>操作</td>
	</tr>
	<?php
		$result = mysqli_query($link, "select * from item");
		while($row = mysqli_fetch_array($result))
		{
			?>
			<tr>
				<td><?=$row["id"]?></td>
				<td><?=$row["name"]?></td>
				<td><?=$row["qt"]?></td>
				<td><?=($row["sell"] == 1)?"販售中":"已下架"?></td>
				<td>
					<input type="button" onclick="lof('?do=editi&id=<?=$row["id"]?>')" value="修改">
					<input type="button" onclick="lof('api.php?do=deli&id=<?=$row["id"]?>')" value="刪除">
					<input type="button" onclick="lof('api.php?do=sell&id=<?=$row["id"]?>')" value="上架">
					<input type="button" onclick="lof('api.php?do=notsell&id=<?=$row["id"]?>')" value="下架">
				</td>
			</tr>
			<?php
		}
	?>
</table>
