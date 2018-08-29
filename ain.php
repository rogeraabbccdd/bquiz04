<?php
	$n = getnums();
?>
管理登入<br>
<form id="in" action="api.php?do=ain" method="post">
帳號<input type="text" name="acc"><br>
密碼<input type="password" name="pw"><br>
<?=($n[0]."+".$n[1]."=")?><input type="text" name="n" id="n">
<input type="button" id="a" value="登入">
<script>
$("#a").on("click", function(e){
	var d = $(this).serialize();
	if($("#n").val() != <?=$n[2]?>)	alert("對不起，您輸入的驗證碼有誤請您重新登入");
	else $("#in").submit();
})
</script>