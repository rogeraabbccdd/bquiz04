<?php
	$result = mysqli_query($link, "select * from item where id = '".$_GET["id"]."'");
	$row = mysqli_fetch_array($result);
?>

<h1>修改商品</h1>
<form action="api.php?do=editi&id=<?=$row["id"]?>" method="post" enctype="multipart/form-data">
<table>
	<tr>
		<td>所屬大類</td>
		<td>
			<select name="c1" id="c1sel" onchange="getc2()">
			<?php
				$result2 = mysqli_query($link, "select * from cat where parent = 0");
				while($row2 = mysqli_fetch_array($result2))
				{
					?>
						<option value="<?=$row2["id"]?>" <?=(($row["c1"] == $row2["id"])?"selected":"")?>><?=$row2["name"]?></option>
					<?php
				}
			?>
		</td>
	</tr>
	<tr>
		<td>所屬中類</td>
		<td>
			<select name="c2" id="c2sel">
			<?php
				$result2 = mysqli_query($link, "select * from cat where parent = '".$row["c1"]."'");
				while($row2 = mysqli_fetch_array($result2))
				{
					?>
						<option value="<?=$row2["id"]?>" <?=(($row["c2"] == $row2["id"])?"selected":"")?>><?=$row2["name"]?></option>
					<?php
				}
			?>
		</td>
	</tr>
	<tr>
		<td>商品編號</td>
		<td><?=$row["id"]?></td>
	</tr>
	<tr>
		<td>商品名稱</td>
		<td><input type="text" name="name" value="<?=$row["name"]?>"></td>
	</tr>
	<tr>
		<td>商品價格</td>
		<td><input type="text" name="price" value="<?=$row["price"]?>"></td>
	</tr>
	<tr>
		<td>規格</td>
		<td><input type="text" name="type" value="<?=$row["type"]?>"></td>
	</tr>
	<tr>
		<td>庫存量</td>
		<td><input type="text" name="qt" value="<?=$row["qt"]?>"></td>
	</tr>
	<tr>
		<td>商品圖片</td>
		<td><input type="file" name="img" value="<?=$row["img"]?>"></td>
	</tr>
	<tr>
		<td>商品介紹</td>
		<td><input type="text" name="text" value="<?=$row["text"]?>"></td>
	</tr>
</table>
<input type="reset">
<input type="submit">
<input type="button" onclick="window.history.back()" value="返回">
</form>
<script>
	function getc2()
	{
		var c1 = $("#c1sel").val();
		$.post("api.php?do=getc2", {c1}, function(r){
			$("#c2sel").html(r);
		})
	}
</script>