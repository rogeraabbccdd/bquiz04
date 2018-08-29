<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
include "sql.php";
$t = mysqli_num_rows(mysqli_query($link, "select * from item where sell = 1"));
?>
<title>┌精品電子商務網站」</title>
<link href="./home_files/css.css" rel="stylesheet" type="text/css">
<script src="./home_files/js.js"></script>
<script src="./home_files/jquery-1.9.1.min.js"></script>
</head>

<body>
<iframe name="back" style="display:none;"></iframe>
	<div id="main" style="width:1024px; height:768px; padding:10px">
    	<div id="top">
        	<a href="?">
            	<img src="./home_files/0416.jpg" height="70px">
           </a>
                        <div style="padding:10px; float:right">
                <a href="?">回首頁</a> |
                <a href="?do=news">最新消息</a> |
                <a href="?do=look">購物流程</a> |
                <a href="?do=buycart">購物車</a> |
                                <a href="<?=(empty($_SESSION["u"]))?"?do=login":"api.php?do=out"?>"><?=(empty($_SESSION["u"]))?"會員登入":"登出"?></a> |
                                <a href="?do=ain">管理登入</a>
           </div>
                <marquee>情人節特惠活動 &nbsp; 年終特賣會開跑了  </marquee>       </div>
        <div id="left" class="ct">
        	<div style="min-height:400px;">
			<div class='ww'><a href='?c=0'>全部商品(<?=$t?>)</a></div>
			<?php
				$result = mysqli_query($link, "select * from cat where parent = 0");
				while($row = mysqli_fetch_array($result))
				{
					$c = mysqli_num_rows(mysqli_query($link, "select * from item where c1 = '".$row["id"]."'"));
					echo "<div class='ww'><a href='?c=".$row["id"]."'>".$row["name"]."(".$c.")</a>";
					
					$result2 = mysqli_query($link, "select * from cat where parent = '".$row["id"]."'");
					while($row2 = mysqli_fetch_array($result2))
					{
						$cc = mysqli_num_rows(mysqli_query($link, "select * from item where c2 = '".$row2["id"]."'"));
						echo "<div class='s'><a href='?c=".$row2["id"]."'>".$row2["name"]."(".$cc.")</div></a>";
					}
					echo "</div>";
				}
			?>
        	            </div>
                        <span>
            	<div>進站總人數</div>
                <div style="color:#f00; font-size:28px;">
                	00005                </div>
            </span>
                    </div>
        <div id="right" style="overflow-y:scroll; height:500px">
		<?php
			$p = "main";
			if(!empty($_GET["do"]))	$p = $_GET["do"];
			if($p == "look")	echo "<img src='images/0401.jpg'>";
			else include $p.".php";
		?>
        	        </div>
        <div id="bottom" style="line-height:70px;background:url(icon/bot.png); color:#FFF;" class="ct">
        	頁尾版權 :   <?=$footer?>     </div>
    </div>

</body></html>