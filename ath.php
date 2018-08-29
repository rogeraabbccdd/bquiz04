<a href="?redo=th">商品分類</a>/<a href="?redo=ei">商品管理</a><br>
<form action="api.php?do=nc1" method="post">新增大類<input type="text" name="c1"><input type="submit"></form>
<form action="api.php?do=nc2" method="post">新增中類
<select name="c1">
	<?php
	$result = mysqli_query($link, "select * from cat where parent = 0");
	while($row = mysqli_fetch_array($result))
	{
		?>
		<option value="<?=$row["id"]?>"><?=$row["name"]?></option>
		<?php
	}
	?>
</select>
<input type="text" name="c2"><input type="submit"></form>
<form action="api.php?do=ec" method="post">
<?php
	$result = mysqli_query($link, "select * from cat where parent = 0");
	while($row = mysqli_fetch_array($result))
	{
		echo "<input type='text' value='".$row["name"]."' name='text[]'>
		<input type='hidden' value='".$row["id"]."' name='id[]'>
		<input type='checkbox' value='".$row["id"]."' name='del[]'><br>";
		$result2 = mysqli_query($link, "select * from cat where parent = '".$row["id"]."'");
		while($row2 = mysqli_fetch_array($result2))
		{
			echo "<input type='text' value='".$row2["name"]."' name='text[]'>
			<input type='hidden' value='".$row2["id"]."' name='id[]'>
			<input type='checkbox' value='".$row2["id"]."' name='del[]'><br>";
		}
		echo "<hr>";
	}
	?>
	<input type="submit">
</form>


<script>

</script>