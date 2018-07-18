<?php
	$c = 0;
	if(!empty($_GET["c"]))	$c = $_GET["c"];
	
	$sql = "select * from item where sell = 1";
	
	if($c != 0)
	{
		// 檢查是不是大分類
		$chk = mysqli_fetch_array(mysqli_query($link, "select * from cat where id = '".$c."'"))["parent"];
	
		// 大分類，parent為0
		if($chk == 0)
		{
			$sql = "select * from item where c1 = '".$c."' and sell = 1";
			
			// 大分類名字
			$nav = mysqli_fetch_array(mysqli_query($link, "select * from cat where id = '".$c."'"))["name"];
		}
		// 小分類
		else
		{
			$sql = "select * from item where c2 = '".$c."' and sell = 1";
			
			// 先查中分類的parent，再查大分類名字
			$id = mysqli_fetch_array(mysqli_query($link, "select * from cat where id = '".$c."'"))["parent"];
			$nav1 = mysqli_fetch_array(mysqli_query($link, "select * from cat where id = '".$id."'"))["name"];
			
			// 中分類名字
			$nav2 = mysqli_fetch_array(mysqli_query($link, "select * from cat where id = '".$c."'"))["name"];
			
			$nav = $nav1.">".$nav2;
		}
	}
	else $nav = "全部商品";
	
	echo "<h1>".$nav."</h1>";
	
	$result = mysqli_query($link, $sql);
	while($row = mysqli_fetch_array($result))
	{
		?>
		<table class="all">
			 <tr> <td rowspan="5" class="pp ct" width="40%"><a href="?i=<?=$row["id"]?>"><img src="images/<?=$row["img"]?>" width="200"/></a></td></tr>      
			 <tr> <td class="tt ct"><?=$row["name"]?></td></tr>     
			 <tr> <td class="pp ct">價格:<?=$row["price"]?><span style="float:right"><img src="images/0402.jpg" onclick="lof('?do=buycart&i=<?=$row["id"]?>')"></span></td></tr> 
			 <tr> <td class="pp ct">規格:<?=$row["type"]?></td></tr> 
			 <tr><td class="pp ct">簡介:<?=$row["text"]?></td></tr> 
		</table>       
		<?php
	}
?>
