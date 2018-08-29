<?php
	if(empty($_SESSION["u"]))	lo("?do=login");
	
	if(empty($_SESSION["c"]) && empty($_GET["i"]))
		echo "購物車沒有商品";
	
	else
	{
		if(!empty($_GET["i"]))	$_SESSION["c"][$_GET["i"]] = $_GET["q"];
		itemlist($_SESSION["c"], 1);
		echo "<img src='images/0411.jpg' onclick='lof(\"index.php\")'>";
		echo "<img src='images/0412.jpg' onclick='lof(\"?do=out\")'>";
	}
?>