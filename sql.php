<?php
	$link = mysqli_connect("localhost", "root", "", "dbxx4");
	mysqli_query($link, "set names utf8");
	session_start();
	$footer = mysqli_fetch_array(mysqli_query($link, "select * from footer"))[0];
?>