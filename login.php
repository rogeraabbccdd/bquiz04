<?php
    $num = rand(1, 100);
    $num2 = rand(1, 100);
    $num3 = $num + $num2;
?>
<h1>第一次購物</h1>
<a href="?do=reg"><img src="images/0413.jpg"></a>
<br>
<h1>會員登入</h1>
<form id="login" method="post">
    <table width="90%">
        <tr>
            <td class="tt ct">帳號</td>
            <td class="pp"><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td class="tt ct">密碼</td>
            <td class="pp"><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td class="tt ct">驗證碼</td>
            <td class="pp"><?=$num?> + <?=$num2?> = <input type="text" name="verify" id="verify"></td>
        </tr>
        <tr>
            <td colspan="2" class="pp"><input type="submit" value="送出"></td> 
        </tr>
    </table>
</form>
<script>
    $("#login").on("submit", function(e){
        e.preventDefault();
        var acc = $("#acc").val();
        var pw = $("#pw").val();
        if($("#verify").val() != <?=$num3?>) alert("對不起，您輸入的驗證碼有誤!");
        else
        {
            $.post("api.php?do=login", {acc, pw}, function(r){
                if(r == "wrong")    alert("帳號或密碼錯誤");
                else if(r == "success")    window.location.href="index.php";
            })
        }
    })
</script>