<a href="?redo=na">新增管理員</a><br>
<?php
	$result = mysqli_query($link, "select * from admin");
	while($row = mysqli_fetch_array($result))
	{
		echo "
		帳號".$row["acc"]."<br>
		密碼".$row["pw"]."<br>";
		if($row["id"] != 1)
		{
			echo "
		<input type='button' value='修改' onclick='lof(\"?redo=ea&id=".$row["id"]."\")'>
		<input type='button' value='刪除' onclick='lof(\"api.php?do=da\")'>
		";
		}
		else echo "此為最高管理權限帳號";
		echo "<hr>";
	}
?>