<?php
	include("sql.php");
	switch($_GET["do"])
	{
		case "in":
			$result = All("select * from user where acc = '".$_POST["acc"]."' and pw = '".$_POST["pw"]."'");
			$num = count($result);
			
			if($num > 0) 
			{
                $_SESSION = $result[0];
				lo("index.php");
			}
			else echo "<script>alert('帳號或密碼錯誤'); window.location='index.php?do=login';</script>";
			break;
			
		case "chk":
			$n = count(All("select * from user where acc = '".$_POST["a"]."'"));
			if($n > 0) echo "x";
			else echo "ok";
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
            unset($_SESSION["cart"][$_GET["id"]]);
            lo("index.php?do=buycart");
            break;

        case "chkout":
            $cart = serialize($_SESSION["cart"]);
            $time = strtotime("now");
            $d = array(
                "user" => $_SESSION["id"],
                "item" => $cart,
                "time" => $time
            );
            upd("ord", $d, 0, 1);
            unset($_SESSION["cart"]);
            lo("index.php");
			break;
			
		case "ain":
			$row = All("select * from admin where acc = '".$_POST["acc"]."' and pw = '".$_POST["pw"]."'")[0];
			$num = count($row);
			if($num > 0) 
			{
				$_SESSION["id"] = $row["id"];
				$_SESSION["permit"] =  unserialize($row["permit"]);
				lo("admin.php");
			}
			else echo "<script>alert('帳號或密碼錯誤'); window.location='index.php?do=ain';</script>";
			break;
		
		case "eadmin":
			$_POST["permit"] = serialize($_POST["permit"]);
			upd("admin", $_POST, $_GET["id"], 0);
			lo("admin.php?redo=admin");
			break;
		
		case "nadmin":
			$_POST["permit"] = serialize($_POST["permit"]);
			upd("admin", $_POST, 0, 1);
			lo("admin.php?redo=admin");
			break;

		case "deladmin":
			All("delete from admin where id = '".$_GET["id"]."'");
			lo("admin.php?redo=admin");
			break;
		
		case "nc1":
			All("insert into cat values(null, '".$_POST["c1"]."', 0)");
			lo("admin.php?redo=th");
			break;
			
		case "nc2":
			All("insert into cat values(null, '".$_POST["c2"]."', '".$_POST["c1"]."')");
			lo("admin.php?redo=th");
			break;

		case "ec":
			for($i=0;$i<count($_POST["id"]);$i++)
			{
				All("update cat set name = '".$_POST["text"][$i]."' where id = '".$_POST["id"][$i]."'");
			}
			foreach($_POST["del"] as $d)
			{
				All("delete from cat where id = '".$d."'");
			}
			lo("admin.php?redo=th");
			break;

		case "delitem":
			All("delete from item where id = '".$_GET["id"]."'");
			lo("admin.php?redo=item");
			break;
			
		case "sell":
			All("update item set sell = 1 where id = '".$_GET["id"]."'");
			lo("admin.php?redo=item");
			break;
			
		case "usell":
			All("update item set sell = 0 where id = '".$_GET["id"]."'");
			lo("admin.php?redo=item");
			break;

		case "getc2":
			$r = "";
			$result = All("select * from cat where parent = '".$_POST["c1"]."'");
			foreach($result as $row)
			{
				$r .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
			}
			echo $r;
			break;
		
		case "nitem":
			$_POST["sell"] = 1;
			upd("item", $_POST, 0, 1);
			lo("admin.php?redo=ni");
			break;

		case "eitem":
			upd("item", $_POST, $_GET["id"], 0);
			lo("admin.php?redo=ni");
			break;

		case "delorder":
			All("delete from ord where id = '".$_GET["id"]."'");
			lo("admin.php?redo=order");
			break;

		case "delu":
			All("delete from user where id = '".$_GET["id"]."'");
			lo("admin.php?redo=mem");
			break;

		case "editu":
			upd("user", $_POST, $_GET["id"], 0);
			lo("admin.php?redo=mem");
			break;

		case "foot":
			All("update foot set foot = '".$_POST["foot"]."'");
			lo("admin.php?redo=bot");
			break;
    }
?>