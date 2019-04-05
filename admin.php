<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0057)?do=admin -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
	include("sql.php");
?>
<title>┌精品電子商務網站」</title>
<link href="./Manage Page_files/css.css" rel="stylesheet" type="text/css">
<script src="./Manage Page_files/js.js"></script>
<script src="./jquery-1.9.1.min.js"></script>
</head>

<body>
<iframe name="back" style="display:none;"></iframe>
	<div id="main">
    	<div id="top">
        	<a href="?">
            	<img src="./Manage Page_files/0416.jpg" height="50px">
            </a>
                            <img src="./Manage Page_files/0417.jpg" height="50px">
                   </div>
        <div id="left" class="ct">
        	<div style="min-height:400px;">
			<?=($_SESSION["id"] == 1)?"<a href='?do=admin&redo=admin'>管理權限設置</a>":""?>
            	            <?=(in_array(1, $_SESSION["permit"]))?"<a href='?do=admin&redo=th'>商品分類與管理</a>":""?>
<?=(in_array(2, $_SESSION["permit"]))?"<a href='?do=admin&redo=order'>訂單管理</a>":""?>
<?=(in_array(3, $_SESSION["permit"]))?"<a href='?do=admin&redo=mem'>會員管理</a>":""?>
<?=(in_array(4, $_SESSION["permit"]))?"<a href='?do=admin&redo=bot'>頁尾版權管理</a>":""?>
<?=(in_array(5, $_SESSION["permit"]))?"<a href='?do=admin&redo=news'>最新消息管理</a>":""?>
            	        	<a href="api.php?do=out" style="color:#f00;">登出</a>
                    </div>
                    </div>
		<div id="right"  style="overflow-y:scroll; height:500px">
		<?php
			if(!empty($_GET["redo"]))	include("a".$_GET["redo"].".php");
			else echo "請選擇管理項目";
		?>
        	        </div>
        <div id="bottom" style="line-height:70px; color:#FFF; background:url(icon/bot.png);" class="ct">
        	頁尾版權 :    <?=$foot?></div>
    </div>

</body></html>