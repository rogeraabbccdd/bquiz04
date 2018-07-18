<h2><a href="?do=th">商品分類</a> / <a href="?do=th2">商品管理</a></h2>
<h1>商品分類</h1>
<form id="c1" method="post" action="api.php?do=newc1">
	新增大類<input type="text" name="c1"><input type="submit">
</form>
<form id="c2" method="post" action="api.php?do=newc2">
	新增中類<select name="c1">
	<?php
		$result = mysqli_query($link, "select * from cat where parent = 0");
		while($row = mysqli_fetch_array($result))
		{
			?>
				<option value="<?=$row["id"]?>"><?=$row["name"]?></option>
			<?php
		}
	?>
	<input type="text" name="c2"><input type="submit">
</form>
<table>
	<?php
		$result = mysqli_query($link, "select * from cat where parent = 0");
		while($row = mysqli_fetch_array($result))
		{
			?>
			<tr id="c<?=$row["id"]?>">
				<td id="cname<?=$row["id"]?>"><?=$row["name"]?></td>
				<td>
					<input type="button" onclick="edit('<?=$row["id"]?>')" value="修改">
					<input type="button" onclick="del('<?=$row["id"]?>')" value="刪除">
				</td>
			</tr>
			<?php
				$result2 = mysqli_query($link, "select * from cat where parent = '".$row["id"]."'");
				while($row2 = mysqli_fetch_array($result2))
				{
					?>
					<tr id="c<?=$row2["id"]?>">
						<td id="cname<?=$row2["id"]?>"><?=$row2["name"]?></td>
						<td>
							<input type="button" onclick="edit('<?=$row2["id"]?>')" value="修改">
							<input type="button" onclick="lof('api.php?do=delc&id=<?=$row2["id"]?>')" value="刪除">
						</td>
					</tr>
					<?php
				}
			?>
			<?php
		}
	?>
</table>
<script>
	function edit(id)
	{
		var name = $("#cname"+id).html();
		name2 = prompt("請輸入要修改的名稱", name)
		$.post("api.php?do=editc", {id, name2}, function(r){
			$("#cname"+id).html(name2);
		})
	}
</script>