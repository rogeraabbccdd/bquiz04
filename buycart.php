<?php
	if(empty($_SESSION))	lo("?do=login");
	
	if(empty($_SESSION["cart"]) && empty($_GET["i"]))
		echo "購物車沒有商品";
	
	else
	{
		if(!empty($_GET["i"]))	$_SESSION["cart"][$_GET["i"]] = $_GET["q"];
		itemlist($_SESSION["cart"], 1);
		echo "<img src='img/0411.jpg' onclick='lof(\"index.php\")'>";
		echo "<img src='img/0412.jpg' onclick='lof(\"?do=out\")'>";
	}
?>