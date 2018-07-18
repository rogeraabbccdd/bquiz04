<?php
	$result = mysqli_query($link, "select * from ord where id = '".$_GET["id"]."'");
	$row = mysqli_fetch_array($result);
	$item = unserialize($row["item"]);
	$qt = unserialize($row["qt"]);
	$id = date("YmdHis",$row["timestamp"]);
	$acc = mysqli_fetch_array(mysqli_query($link, "select * from user where id = '".$row["id"]."'"))["acc"];
?>
<h1>訂單編號<?=$id?>的詳細資料</h1>
<table>
	<tr>
		<td>會員帳號</td>
		<td colspan="4"><?=$acc?></td>
	</tr>
	<tr>
		<td>姓名</td>
		<td colspan="4"><?=$row["name"]?></td>
	</tr>
	<tr>
		<td>電子信箱</td>
		<td colspan="4"><?=$row["mail"]?></td>
	</tr>
	<tr>
		<td>聯絡地址</td>
		<td colspan="4"><?=$row["adr"]?></td>
	</tr>
	<tr>
		<td>聯絡電話</td>
		<td colspan="4"><?=$row["tel"]?></td>
	</tr>
	<tr>
		<td>商品名稱</td>
		<td>編號</td>
		<td>數量</td>
		<td>單價</td>
		<td>小計</td>
	</tr>
	<?php
		$total = 0;
		for($i =0; $i<count($item); $i++)
		{
			$result2 = mysqli_query($link, "select * from item where id = '".$item[$i]."'");
			$row2 = mysqli_fetch_array($result2);
			$price2 = $row2["price"]*$qt[$i];
			$total += $price2;
			?>
				<tr>
					<td><?=$row2["name"]?></td>
					<td><?=$row2["id"]?></td>
					<td><?=$qt[$i]?></td>
					<td><?=$row2["price"]?></td>
					<td><?=$price2?></td>
				</tr>
			<?php
		}
	?>
	<tr><td colspan="5">總價：<?=$total?></td></tr>
</table>
<button type="button" onclick="window.history.back();">返回</button>