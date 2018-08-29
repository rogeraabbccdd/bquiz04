<?php
	userdata($_SESSION["u"]);
	itemlist($_SESSION["c"], 0);
?>
<input type="button" value="確定送出" onclick="lof('api.php?do=chkout')" >
<input type="button" value="返回修改訂單" onclick="lof('?do=buycart')" >