<h1>新增商品</h1>
<form action="api.php?do=newi" method="post" enctype="multipart/form-data">
<table>
	<tr>
		<td>所屬大類</td>
		<td>
			<select name="c1" id="c1sel" onchange="getc2()">
			<?php
				$result = mysqli_query($link, "select * from cat where parent = 0");
				while($row = mysqli_fetch_array($result))
				{
					?>
						<option value="<?=$row["id"]?>"><?=$row["name"]?></option>
					<?php
				}
			?>
		</td>
	</tr>
	<tr>
		<td>所屬中類</td>
		<td>
			<select name="c2" id="c2sel">
				<option value=""></option>
		</td>
	</tr>
	<tr>
		<td>商品編號</td>
		<td>系統自動產生</td>
	</tr>
	<tr>
		<td>商品名稱</td>
		<td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td>商品價格</td>
		<td><input type="text" name="price"></td>
	</tr>
	<tr>
		<td>規格</td>
		<td><input type="text" name="type"></td>
	</tr>
	<tr>
		<td>庫存量</td>
		<td><input type="text" name="qt"></td>
	</tr>
	<tr>
		<td>商品圖片</td>
		<td><input type="file" name="img"></td>
	</tr>
	<tr>
		<td>商品介紹</td>
		<td><input type="text" name="text"></td>
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
	getc2();
</script>