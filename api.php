<?php
	include "sql.php";
	if(!empty($_GET["do"]))
	{
		if($_GET["do"] == "logout")
		{
			session_unset();
			session_destroy();
			header("location:index.php");
		}
		elseif($_GET["do"] == "check")
		{
			$result = mysqli_query($link, "select * from user where acc = '".$_POST["acc"]."'");
			if(mysqli_num_rows($result) > 0)    echo "used";
			else echo "ok"; 
		}
		elseif($_GET["do"] == "login")
		{
			$result = mysqli_query($link, "select * from user where acc = '".$_POST["acc"]."' and pw = '".$_POST["pw"]."'");
			if(mysqli_num_rows($result) < 1)    echo "wrong";
			else
			{
				$row = mysqli_fetch_array($result);
				$_SESSION["id"] = $row["id"];
				$_SESSION["user"] = $row["acc"];
				$_SESSION["name"] = $row["name"];
				$_SESSION["tel"] = $row["tel"];
				$_SESSION["adr"] = $row["adr"];
				$_SESSION["mail"] = $row["mail"];
				echo "success";
			}
		}
		elseif($_GET["do"] == "reg")
		{
			mysqli_query($link, "insert into user 
			values(null, '".$_POST["acc"]."', '".$_POST["pw"]."' , '".$_POST["name"]."', '".$_POST["tel"]."'
			, '".$_POST["adr"]."', '".$_POST["mail"]."')");

			$_SESSION["id"] = mysqli_insert_id($link);
			$_SESSION["user"] = $_POST["acc"];
			$_SESSION["name"] = $_POST["name"];
			$_SESSION["user"] = $_POST["acc"];
			$_SESSION["name"] = $_POST["name"];
			$_SESSION["tel"] = $_POST["tel"];
			$_SESSION["adr"] = $_POST["adr"];
			$_SESSION["mail"] = $_POST["mail"];

			header("location:index.php");
		}
		elseif($_GET["do"] == "delcart")
		{
			array_splice($_SESSION['i'], $_POST['i'], 1);
			array_splice($_SESSION['qt'], $_POST['i'], 1);
		}
		elseif($_GET["do"] == "qt")
		{
			$_SESSION['qt'][$_POST["i"]] = $_POST["qt"];
		}
		elseif($_GET["do"] == "out")
		{
			$item = serialize($_SESSION["i"]);
			$qt = serialize($_SESSION["qt"]);
			$time = strtotime("now");
			$result = mysqli_query($link, "insert into ord values(null, '".$_SESSION["id"]."', '".$_POST["name"]."', '".$_POST["mail"]."', '".$_POST["adr"]."', '".$_POST["tel"]."', '".$item."', '".$qt."', '".$time."')");
		}
		elseif($_GET["do"] == "admlogin")
		{
			$result = mysqli_query($link, "select * from admin where acc = '".$_POST["acc"]."' and pw = '".$_POST["pw"]."'");
			if(mysqli_num_rows($result) < 1)    echo "wrong";
			else
			{
				$row = mysqli_fetch_array($result);
				$_SESSION["id"] = $row["id"];
				$_SESSION["admin"] = $row["acc"];
				$_SESSION["p"] = str_split($row["permit"]);
				echo "success";
			}
		}
		elseif($_GET["do"] == "newa")
		{
			$permit = "00000";
			foreach($_POST["permit"] as $p)
			{
				$permit = substr_replace($permit, "1", $p, 1);
			}
			mysqli_query($link, "insert into  admin values(null, '".$_POST["acc"]."', '".$_POST["pw"]."', '".$permit."')");
			header("location:admin.php?do=aadmin");
		}
		elseif($_GET["do"] == "admlogout")
		{
			session_unset();
			session_destroy();
			header("location:index.php");
		}
		elseif($_GET["do"] == "edita")
		{
			$permit = "00000";
			foreach($_POST["permit"] as $p)
			{
				$permit = substr_replace($permit, "1", $p, 1);
			}
			mysqli_query($link, "update admin set acc = '".$_POST["acc"]."', pw = '".$_POST["pw"]."', permit = '".$permit."' where id = '".$_POST["id"]."'");
			header("location:admin.php?do=aadmin");
		}
		elseif($_GET["do"] == "delord")
		{
			mysqli_query($link, "delete from ord where id = '".$_POST["id"]."'");
			echo "success";
		}
		elseif($_GET["do"] == "deluser")
		{
			mysqli_query($link, "delete from user where id = '".$_POST["id"]."'");
			echo "success";
		}
		elseif($_GET["do"] == "edituser")
		{
			mysqli_query($link, "update user set name = '".$_POST["name"]."', mail = '".$_POST["mail"]."', adr = '".$_POST["adr"]."', tel = '".$_POST["tel"]."' where id = '".$_GET["id"]."'");
			header("location:admin.php?do=edituser&id=".$_GET["id"]);
		}
		elseif($_GET["do"] == "footer")
		{
			mysqli_query($link, "update footer set footer = '".$_POST["text"]."'");
			header("location:admin.php?do=bot");
		}
		elseif($_GET["do"] == "newc1")
		{
			mysqli_query($link, "insert into cat values (null, '".$_POST["c1"]."', 0)");
			header("location:admin.php?do=th");
		}
		elseif($_GET["do"] == "newc2")
		{
			mysqli_query($link, "insert into cat values (null, '".$_POST["c2"]."', '".$_POST["c1"]."')");
			header("location:admin.php?do=th");
		}
		elseif($_GET["do"] == "editc")
		{
			mysqli_query($link, "update cat set name = '".$_POST["name2"]."' where id = '".$_POST["id"]."'");
		}
		elseif($_GET["do"] == "delc")
		{
			mysqli_query($link, "delete from cat where id = '".$_GET["id"]."'");
			header("location:admin.php?do=th");
		}
		elseif($_GET["do"] == "deli")
		{
			mysqli_query($link, "delete from item where id = '".$_GET["id"]."'");
			header("location:admin.php?do=th2");
		}
		elseif($_GET["do"] == "sell")
		{
			mysqli_query($link, "update item set sell = '1' where id = '".$_GET["id"]."'");
			header("location:admin.php?do=th2");
		}
		elseif($_GET["do"] == "notsell")
		{
			mysqli_query($link, "update item set sell = '0' where id = '".$_GET["id"]."'");
			header("location:admin.php?do=th2");
		}
		elseif($_GET["do"] == "getc2")
		{
			$r = "";
			$result = mysqli_query($link, "select * from cat where parent = '".$_POST["c1"]."'");
			while($row = mysqli_fetch_array($result))
			{
				$r .= "<option value='".$row["id"]."'>".$row["name"]."</option>";
			}
			echo $r;
		}
		elseif($_GET["do"] == "newi")
		{
			if(!empty($_FILES["img"]))
			{
				$now = strtotime("now");
				$ext = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
				copy($_FILES["img"]["tmp_name"], "images/".$now.$ext);
				
				$sql = "insert into item values (null,
					'".$_POST["c1"]."',
					'".$_POST["c2"]."',
					'".$_POST["name"]."',
					'".$_POST["type"]."',
					'".$_POST["qt"]."',
					'".$_POST["price"]."',
					'".$_POST["text"]."',
					'".$now.$ext."', '1')";
			
			}
			else $sql = "insert into item values (null,
			'".$_POST["c1"]."',
			'".$_POST["c2"]."',
			'".$_POST["name"]."',
			'".$_POST["type"]."',
			'".$_POST["qt"]."',
			'".$_POST["price"]."',
			'".$_POST["text"]."',
			'', '1')";
			
			mysqli_query($link, $sql);
			header("location:admin.php?do=th2");
		}
		elseif($_GET["do"] == "editi")
		{
			if(!empty($_FILES["img"]))
			{
				$now = strtotime("now");
				$ext = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
				copy($_FILES["img"]["tmp_name"], "images/".$now.$ext);
				
				$sql = "update item set 
					c1 = '".$_POST["c1"]."',
					c2 = '".$_POST["c2"]."',
					name = '".$_POST["name"]."',
					type = '".$_POST["type"]."',
					qt = '".$_POST["qt"]."',
					price = '".$_POST["price"]."',
					text = '".$_POST["text"]."',
					img = '".$now.$ext."'
					where id = '".$_GET["id"]."'";
			
			}
			else $sql = "update item set 
					c1 = '".$_POST["c1"]."',
					c2 = '".$_POST["c2"]."',
					name = '".$_POST["name"]."',
					type = '".$_POST["type"]."',
					qt = '".$_POST["qt"]."',
					price = '".$_POST["price"]."',
					text = '".$_POST["text"]."'
					where id = '".$_GET["id"]."'";
			
			mysqli_query($link, $sql);
			header("location:admin.php?do=th2");
		}
	}
?>