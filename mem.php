<h1>會員管理</h1>
<table>
	<tr>
		<td>姓名</td>
		<td>會員帳號</td>
		<td>註冊日期</td>
		<td>操作</td>
	</tr>
	<?php
		$result = mysqli_query($link, "select * from user");
		while($row = mysqli_fetch_array($result))
		{
			?>
			<tr>
				<td><?=$row["name"]?></td>
				<td><?=$row["acc"]?></td>
				<td><?=(date("Y/m/d", $row["timestamp"]))?></td>
				<td>
					<button type="button" onclick="lof('?do=edituser&id=<?=$row["id"]?>')">修改</button>
					<button type="button" onclick="del('<?=$row["id"]?>')">刪除</button>
				</td>
			</tr>
			<?php
		}
	?>
</table>
<script>
	function del(id)
	{
		$.post("api.php?do=deluser", {id}, function(r){
			if(r == "success")	$("#ord"+id).remove();
			console.log(r);
		})
	}
</script>