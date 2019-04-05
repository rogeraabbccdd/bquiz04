新增商品<br>
<form action="api.php?do=nitem" method="post" enctype="multipart/form-data">
所屬大類
<select name="c1" onchange="getc2()" id="c1">
	<?php
	$result = All("select * from cat where parent = 0");
	foreach($result as $row)
	{
		?>
		<option value="<?=$row["id"]?>"><?=$row["name"]?></option>
		<?php
	}
	?>
</select><br>
所屬中類<select name="c2" id="c2"></select><br>
商品編號: 完成後自動分配<br>
商品名稱<input type="text" name="name"><br>
商品價格<input type="text" name="price"><br>
規格<input type="text" name="type"><br>
庫存量<input type="text" name="qt"><br>
商品圖片<input type="file" name="file"><br>
商品介紹<textarea name="text"></textarea>
<input type="submit">
<script>
	function getc2()
	{
		var c1 = $("#c1").val();
		$.post("api.php?do=getc2", {c1}, function(r){
			console.log(r);
			$("#c2").html(r);
		})
	}
	getc2();
</script>