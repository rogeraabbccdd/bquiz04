<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0057)?do=admin -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
        include "sql.php";
?>
<title>┌精品電子商務網站」</title>
<link href="./assets/css.css" rel="stylesheet" type="text/css">
<script src="./assets/js.js"></script>
<script src="./assets/jquery-1.9.1.min.js"></script>
</head>

<body>
<iframe name="back" style="display:none;"></iframe>
	<div id="main">
    	<div id="top">
        	<a href="?">
            	<img src="./images/0416.jpg" width="400px">
            </a>
                            <img src="./images/0417.jpg"  height="60px">
                   </div>
        <div id="left" class="ct">
        	<div style="min-height:400px;">
					<a href="?do=admin">管理權限設置</a>
					<?php if($_SESSION["p"][0] == "1") { ?><a href="?do=th">商品分類與管理</a> <?php }?>
					<?php if($_SESSION["p"][1] == "1") { ?><a href="?do=order">訂單管理</a> <?php }?>
					<?php if($_SESSION["p"][2] == "1") { ?><a href="?do=mem">會員管理</a> <?php }?>
            	    <?php if($_SESSION["p"][3] == "1") { ?><a href="?do=bot">頁尾版權管理</a> <?php }?>
            	    <?php if($_SESSION["p"][4] == "1") { ?><a href="?do=news">最新消息管理</a> <?php }?>
            	        	<a href="api.php?do=admlogout" style="color:#f00;">登出</a>
                    </div>
                    </div>
        <div id="right" style="overflow:scroll; height:500px">
		<?php
			if(empty($_GET["do"]) || $_GET["do"] == "admin")	include("aadmin.php");
			else include($_GET["do"].".php");
		?>
        	        </div>
        <div id="bottom" style="line-height:70px; color:#FFF; background:url(icon/bot.png);" class="ct">
        	頁尾版權 : <?=$footer?></div>
    </div>

</body></html>