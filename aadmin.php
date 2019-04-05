<a href="?redo=nadmin">新增管理員</a><br>
<?php
	$result = All("select * from admin");
	foreach($result as $row)
	{
		echo "
		帳號".$row["acc"]."<br>
		密碼".$row["pw"]."<br>";
		if($row["id"] != 1)
		{
			echo "
                <input type='button' value='修改' onclick='lof(\"?redo=eadmin&id=".$row["id"]."\")'>
                <input type='button' value='刪除' onclick='lof(\"api.php?do=deladmin&id=".$row["id"]."\")'>
                ";
		}
		else echo "此為最高管理權限帳號";
		echo "<hr>";
	}
?>