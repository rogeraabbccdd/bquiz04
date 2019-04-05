<?php
	$n = getnums();
?>
第一次購物<br>
<a href="?do=reg"><img src="img/0413.jpg"></a><br>
會員登入<br>
<form id="in" action="api.php?do=in" method="post">
帳號<input type="text" name="acc"><br>
密碼<input type="password" name="pw"><br>
<?=($n[0]."+".$n[1]."=")?><input type="text" name="num" id="num">
<input type="button" id="btn" value="登入">
<script>
$("#btn").on("click", function(e){
	if($("#num").val() != <?=$n[2]?>)	alert("驗證碼錯誤");
	else $("#in").submit();
})
</script>