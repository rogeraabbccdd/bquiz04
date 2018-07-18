<h1>會員註冊</h1>
<form id="reg" action="api.php?do=reg" method="post">
    <table width="90%">
        <tr>
            <td class="tt ct">姓名</td>
            <td class="pp"><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <td class="tt ct">帳號</td>
            <td class="pp">
            <input type="text" name="acc" id="acc">
            <button type="button" id="check" onclick="checkacc(false)">檢查帳號</button>
            </td>
        </tr>
        <tr>
            <td class="tt ct">密碼</td>
            <td class="pp"><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td class="tt ct">電話</td>
            <td class="pp"><input type="text" name="tel" id="tel"></td>
        </tr>
        <tr>
            <td class="tt ct">住址</td>
            <td class="pp"><input type="text" name="adr" id="adr"></td>
        </tr>
        <tr>
            <td class="tt ct">電子信箱</td>
            <td class="pp"><input type="text" name="mail" id="mail"></td>
        </tr>
        <tr>
            <td colspan="2" class="pp"><input type="button" value="送出" onclick="checkacc(true)"></td> 
        </tr>
    </table>
</form>
<script>
    function checkacc(s){
        var acc = $("#acc").val();
        if(acc)
        {
            if(acc == "admin")  alert("不能使用admin作為帳號");
            else
            {
                $.post("api.php?do=check", {acc}, function(r)
                {
                    if(r == "used")  alert("帳號已使用");
                    else if(r == "ok")   
                    {
                        if(!s)   alert("帳號可以使用");
                        else $("#reg").submit();
                    }
                })
            }
        }
    }

</script>