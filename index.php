<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
	include "sql.php";
	
	// 使用者有登入
	if(empty($_SESSION["user"]))	$inout = '<a href="?do=login">會員登入</a>';
	else	$inout = '<a href="api.php?do=logout">登出</a>';
	
	if(empty($_SESSION["admin"]))	$ainout = '<a href="?do=admlogin">管理登入</a>';
	else	$ainout = '<a href="admin.php">管理中心</a>';
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
                        <div style="padding:10px; float:right">
                <a href="?">回首頁</a> |
                <a href="?do=news">最新消息</a> |
                <a href="?do=look">購物流程</a> |
                <a href="?do=buycart">購物車</a> |
                                <?=$inout?> |
                                <?=$ainout?>
           </div>
               <marquee> 年終特賣會開跑了 &emsp; 情人節特惠活動 </marquee>     </div>
        <div id="left" class="ct">
        	<div style="min-height:400px;">
				<?php
					// 把列別先放入陣列
					$result = mysqli_query($link, "select * from cat");
					while($row = mysqli_fetch_array($result))
					{
						// 大分類
						if($row["parent"] == "0")
						{
							$count = mysqli_num_rows(mysqli_query($link, "select * from item where c1 = '".$row["id"]."'"));
							$c1[] = array($row["id"], $row["name"], $count);
						}
						// 中分類
						else
						{
							$count = mysqli_num_rows(mysqli_query($link, "select * from item where c2 = '".$row["id"]."'"));
							$c2[$row["parent"]][] = array($row["id"], $row["name"], $count);
						}
					}
					
					$count = mysqli_num_rows(mysqli_query($link, "select * from item"));
					echo '<div class="ww"><a href="?">全部商品('.$count.')</a></div>';
					
					// 取出陣列資料
					foreach($c1 as $cc1)
					{
						// 大分類
						echo '<div class="ww"><a href="?c='.$cc1[0].'">'.$cc1[1].'('.$cc1[2].')</a>';
						
						foreach($c2[$cc1[0]] as $cc2)
						{
							echo '<div class="s"><a href="?c='.$cc2[0].'">'.$cc2[1].'('.$cc2[2].')</a></div>';
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
        <div id="right" style="overflow:scroll; height:500px">
					<?php
						if(empty($_GET) || !empty($_GET["c"]) || !empty($_GET["i"]))	include "item.php";
						elseif(!empty($_GET["do"]))
						{
							if($_GET["do"] == "look")	echo "<img src='images/0401.jpg'>";
							else	include ($_GET["do"].".php");
						}
					?>
        	        </div>
        <div id="bottom" style="line-height:70px;background:url(icon/bot.png); color:#FFF;" class="ct">
        	頁尾版權 : <?=$footer?></div>
    </div>

</body></html>