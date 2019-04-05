<?php
    $pdo = new PDO("mysql:host=localhost;dbname=dbxx4;charset=utf8", "root", "");
    session_start();

    function All($sql)
    {
        global $pdo;
        return $pdo->query($sql)->fetchAll();
    }

    function lo($l)
    {
        return header("location:".$l);
    }

    function isc1($c)
    {
        global $link;
        $cc = All("select parent from cat where id = '".$c."'")[0][0];
        if($cc == 0)	return true;
        else return false;
    }

    function getnums()
    {
        $n1 = rand(10, 99);
        $n2 = rand(10, 99);
        $n3 = $n1 + $n2;
        $r = array($n1, $n2, $n3);
        return $r;
    }

    function upd($table, $data, $id, $insert)
    {
        global $pdo;

        if($insert)	
        {
            All("insert into ".$table." (id) values (null)");
            $id = $pdo->lastInsertId();
        }
        foreach($data as $key=>$value)
        {
            All("update ".$table." set ".$key." = '".$value."' where id = '".$id."'");
        }

        if(!empty($_FILES["file"]))
        {
            $time = strtotime("now");
            $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $fn = $time.".".$ext;
            copy($_FILES["file"]["tmp_name"], "img/".$fn);
            All("update ".$table." set file = '".$fn."' where id = '".$id."'");
        }
    }

    function itemlist($data, $del)
	{
		$totalmoney = 0;
		foreach($data as $k=> $v)
		{
			$row =  All("select * from item where id = '".$k."'")[0];
			$money = $v*$row["price"];
			$totalmoney += $money;
			echo "
			編號:".$row["id"]."<br>
			商品名稱:".$row["name"]."<br>
			數量:".$v."<br>
			庫存量:".$row["qt"]."<br>
			單價:".$row["price"]."<br>
			小計:".$money."<br>";
			
			if($del) echo "<input type='button' value='刪除' onclick='lof(\"api.php?do=delcart&id=".$k."\")'>";
			
			echo "<hr>";
		}
		echo "總金額:".$totalmoney;
	}
	
	function userdata($user)
	{
		$row = All("select * from user where id = '".$user."'")[0];
		
		echo "
            姓名:".$row["name"]."<br>
            帳號:".$row["acc"]."<br>
            電話:".$row["tel"]."<br>
            住址:".$row["adr"]."<br>
            電子信箱:".$row["mail"]."<br>
            <hr>";
    }
    
    $foot = All("select * from foot")[0][0];
?>