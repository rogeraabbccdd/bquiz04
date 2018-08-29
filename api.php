<?php
	include "sql.php";
	switch($_GET["do"])
	{
		case "in":
			$r = mysqli_query($link, "select * from user where acc = '".$_POST["acc"]."' and pw = '".$_POST["pw"]."'");
			$n = mysqli_num_rows($r);
			
			if($n > 0) 
			{
				$row = mysqli_fetch_array($r);
				$_SESSION["u"] = $row["id"];
				lo("index.php");
			}
			else echo "<script>alert('帳號或密碼錯誤'); window.location='index.php?do=login';</script>";
			break;
			
		case "chk":
			$n = mysqli_num_rows(mysqli_query($link, "select * from user where acc = '".$_POST["a"]."'"));
			if($n > 0) echo "x";
			else echo "s";
			break;
		
		case "reg":
			$_POST["t"] = strtotime("now");
			upd("user", $_POST, 0, 1);
			lo("index.php?do=login");
			break;
		
		case "out":
			session_unset();
			session_destroy();
			lo("index.php");
			break;
		
		case "delcart":
			unset($_SESSION["c"][$_GET["id"]]);
			lo("index.php?do=buycart");
			break;
			
		case "chkout":
			$o = serialize($_SESSION["c"]);
			$t = strtotime("now");
			$d = array(
			"user" => $_SESSION["u"],
			"item" => $o,
			"t" => $t
			);
			upd("ord", $d, 0, 1);
			unset($_SESSION["c"]);
			lo("index.php");
			break;
			
		case "ain":
			$r = mysqli_query($link, "select * from admin where acc = '".$_POST["acc"]."' and pw = '".$_POST["pw"]."'");
			$n = mysqli_num_rows($r);
			
			if($n > 0) 
			{
				$row = mysqli_fetch_array($r);
				$_SESSION["a"] = $row["id"];
				$_SESSION["p"] = unserialize($row["permit"]);
				lo("admin.php");
			}
			else echo "<script>alert('帳號或密碼錯誤'); window.location='index.php?do=login';</script>";
			break;
			
		case "na":
			$_POST["permit"] = serialize($_POST["permit"]);
			upd("admin", $_POST, 0, 1);
			lo("admin.php?redo=admin");
			break;
			
		case "nc1":
			mysqli_query($link, "insert into cat values(null, '".$_POST["c1"]."', 0)");
			lo("admin.php?redo=th");
			break;
			
		case "nc2":
			mysqli_query($link, "insert into cat values(null, '".$_POST["c2"]."', '".$_POST["c1"]."')");
			lo("admin.php?redo=th");
			break;
			
		case "ec":
			for($i=0;$i<count($_POST["id"]);$i++)
			{
				mysqli_query($link, "update cat set name = '".$_POST["text"][$i]."' where id = '".$_POST["id"][$i]."'");
			}
			foreach($_POST["del"] as $d)
			{
				mysqli_query($link, "delete from cat where id = '".$d."'");
			}
			lo("admin.php?redo=th");
			break;
			
		case "deli":
			mysqli_query($link, "delete from item where id = '".$_GET["id"]."'");
			lo("admin.php?redo=ei");
			break;
			
		case "s":
			mysqli_query($link, "update item set sell = 1 where id = '".$_GET["id"]."'");
			lo("admin.php?redo=ei");
			break;
			
		case "us":
			mysqli_query($link, "update item set sell = 0 where id = '".$_GET["id"]."'");
			lo("admin.php?redo=ei");
			break;
		
		case "getc2":
			$r = "";
			$result = mysqli_query($link, "select * from cat where parent = '".$_POST["c1"]."'");
			while($row = mysqli_fetch_array($result))
			{
				$r .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
			}
			echo $r;
			break;
		
		case "ni":
			upd("item", $_POST, 0, 1);
			lo("admin.php?redo=ni");
			break;
			
		case "ei":
			upd("item", $_POST, $_GET["id"], 0);
			lo("admin.php?redo=ni");
			break;
			
		case "ea":
			$_POST["permit"] = serialize($_POST["permit"]);
			upd("admin", $_POST, $_GET["id"], 0);
			lo("admin.php?redo=admin");
			break;
			
		case "delo":
			mysqli_query($link, "delete from ord where id = '".$_GET["id"]."'");
			lo("admin.php?redo=order");
			break;
		
		case "delm":
			mysqli_query($link, "delete from user where id = '".$_GET["id"]."'");
			lo("admin.php?redo=mem");
			break;
			
		case "em":
			upd("user", $_POST, $_GET["id"], 0);
			lo("admin.php?redo=mem");
			break;
			
		case "f":
			mysqli_query($link, "update foot set foot = '".$_POST["foot"]."'");
			lo("admin.php?redo=bot");
			break;
	}
?>