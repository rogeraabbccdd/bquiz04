<h1>最新消息</h1>
<?php
    if(empty($_GET["n"]))
    {
        ?>
            <p color="#F00">*點擊標題觀看詳細資訊</p>
            <table width="90%">
                <tr class="tt ct"><td>標題</td></tr>
                <tr class="pp"><td><a href="?do=news&n=1">年終特賣會開跑了</td></a></tr>
                <tr class="pp"><td><a href="?do=news&n=2">情人節特惠活動</td></tr>
            </table>
        <?php
    }
    elseif($_GET["n"] == 1)
    {
        ?>
            <table width="90%">
                <tr>
                    <td class="tt ct">標題</td>
                    <td class="pp">年終特賣會開跑了</td>
                </tr>
                <tr>
                    <td class="tt ct">內容</td>
                    <td class="pp">即日期至年底，凡會員購物滿仟送佰，買越多送越多~</td>
                </tr>
            </table>
        <?php
    }
    elseif($_GET["n"] == 2)
    {
        ?>
            <table width="90%">
                <tr>
                    <td class="tt ct">標題</td>
                    <td class="pp">情人節特惠活動</td>
                </tr>
                <tr>
                    <td class="tt ct">內容</td>
                    <td class="pp">為了慶祝七夕情人節，將舉辦情人兩人到現場有七七折之特惠活動~</td>
                </tr>
            </table>
        <?php
    }
?>
