<?php
	$link = mysqli_connect("localhost", "root", "", "dbxx4");
	mysqli_query($link, "set names utf8");
	session_start();
	function upfile($tbl, $id)
	{
		global $link;
		$time = strtotime("now");
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$fn = $time.".".$ext;
		copy($_FILES["file"]["tmp_name"], "images/".$fn);
		mysqli_query($link, "update ".$tbl." set file = '".$fn."' where id = '".$id."'");
		echo "update ".$tbl." set file = '".$fn."' where id = '".$id."'";
		
	}
	
	function upd($t, $d, $id, $i)
	{
		global $link;
		if($i)	
		{
			mysqli_query($link, "insert into ".$t." (id) values (null)");
			$id = mysqli_insert_id($link);
		}
		foreach($d as $k=>$v)
		{
			mysqli_query($link, "update ".$t." set ".$k." = '".$v."' where id = '".$id."'");
		}
		
		upfile($t, $id);
	}
	
	function pagelink($tp, $np, $do)
	{
		$nexp = $np+=1;
		$lp = $np-=1;
		if($nexp > $tp)	$nexp = $tp;
		if($lp < 1)	$lp = 1;
		
		echo "<a href='?do=".$do."&p=".$lp."'><</a>";
		
		for($i=1;$i<=$tp; $i++)
		{
			if($i == $np)	echo "<font size='20px'><a href='?do=".$do."&p=".$i."'>".$i."</a></font>";
			else	echo "<a href='?do=".$do."&p=".$i."'>".$i."</a>";
		}
		
		echo "<a href='?do=".$do."&p=".$nexp."'>></a>";
	}
	
	function isc1($c)
	{
		global $link;
		$cc = mysqli_fetch_array(mysqli_query($link, "select parent from cat where id = '".$c."'"))[0];
		if($cc == 0)	return true;
		else return false;
	}
	
	function lo($l)
	{
		return header("location:".$l);
	}
	
	function getnums()
	{
		$n1 = rand(10, 99);
		$n2 = rand(10, 99);
		$n3 = $n1 + $n2;
		$r = array("0" => $n1, "1" => $n2, "2" => $n3);
		return $r;
	}
	
	function itemlist($d, $del)
	{
		global $link;
		$tm = 0;
		foreach($d as $k=> $v)
		{
			$result = mysqli_query($link, "select * from item where id = '".$k."'");
			$row = mysqli_fetch_array($result);
			$m = $v*$row["price"];
			$tm += $m;
			echo "
			編號:".$row["id"]."<br>
			商品名稱:".$row["name"]."<br>
			數量:".$v."<br>
			庫存量:".$row["qt"]."<br>
			單價:".$row["price"]."<br>
			小計:".$m."<br>";
			
			if($del)
				echo "<input type='button' value='刪除' onclick='lof(\"api.php?do=delcart&id=".$k."\")'>";
			
			echo "<hr>";
		}
		echo "總金額:".$tm;
	}
	
	function userdata($u)
	{
		global $link;
		
		$result = mysqli_query($link, "select * from user where id = '".$u."'");
		$row = mysqli_fetch_array($result);
		echo "
		姓名:".$row["name"]."<br>
帳號:".$row["acc"]."<br>
電話:".$row["tel"]."<br>
住址:".$row["adr"]."<br>
電子信箱:".$row["mail"]."<br><hr>
		";
		
	}
	$footer = mysqli_fetch_array(mysqli_query($link, "select * from foot"))[0];
?>