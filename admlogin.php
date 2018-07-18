<?php
    $num = rand(1, 100);
    $num2 = rand(1, 100);
    $num3 = $num + $num2;
?>
<h1>管理員登入</h1>
<form id="login" method="post" action="api.php?do=admin">
    <table>
        <tr>
            <td>帳號</td>
            <td><input type="text" id="acc"></td>
        </tr>
        <tr>
            <td>密碼</td>
            <td><input type="password" id="pw"></td>
        </tr>
        <tr>
            <td>驗證碼</td>
            <td><?=$num?> + <?=$num2?> = <input type="text" name="verify" id="verify"></td>
        </tr>
    </table>
    <input type="submit">
</form>
<script>
    $("#login").on("submit", function(e){
        e.preventDefault();
        var acc = $("#acc").val();
        var pw = $("#pw").val();
        if($("#verify").val() != <?=$num3?>) alert("對不起，您輸入的驗證碼有誤!");
        else
        {
            $.post("api.php?do=admlogin", {acc, pw}, function(r){
                if(r == "wrong")    alert("帳號或密碼錯誤");
                else if(r == "success")    window.location.href="admin.php";
            })
        }
    })
</script>