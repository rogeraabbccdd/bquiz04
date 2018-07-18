<h1>訂單管理</h1>
<table>
	<tr>
		<td>訂單編號</td>
		<td>金額</td>
		<td>會員編號</td>
		<td>姓名</td>
		<td>下單時間</td>
		<td>操作</td>
	</tr>
	<?php
		$result = mysqli_query($link, "select * from ord");
		while($row = mysqli_fetch_array($result))
		{
			$item = unserialize($row["item"]);
			$qt = unserialize($row["qt"]);
			
			$total = 0;
            for($i =0; $i<count($item); $i++)
            {
                $result2 = mysqli_query($link, "select * from item where id = '".$item[$i]."'");
                $row2 = mysqli_fetch_array($result2);
                $price2 = $row2["price"]*$qt[$i];
                $total += $price2;
            }
			$acc = mysqli_fetch_array(mysqli_query($link, "select * from user where id = '".$row["id"]."'"))["acc"];
			?>
					<tr id="ord<?=$row["id"]?>">
						<td><a href="?do=ord&id=<?=$row["id"]?>"><?=(date("YmdHis",$row["timestamp"]))?></a></td>
						<td><?=$total?></td>
						<td><?=$acc?></td>
						<td><?=$row["name"]?></td>
						<td><?=(date("Y/m/d",$row["timestamp"]))?></td>
						<td><button type="button" onclick="del('<?=$row["id"]?>')">刪除</button></td>
					</tr>
			<?php
		}
	?>
</table>
<script>
	function del(id)
	{
		$.post("api.php?do=delord", {id}, function(r){
			if(r == "success")	$("#ord"+id).remove();
			console.log(r);
		})
	}
</script>