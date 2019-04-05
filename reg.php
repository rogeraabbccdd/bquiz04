會員註冊
<form id="form" method="post" action="api.php?do=reg">
姓名<input type="text" name="name"><br>
帳號<input type="text" name="acc" id="a"><input type="button" value="檢測帳號" onclick="chk(0)"><br>
密碼<input type="password" name="pw"><br>
電話<input type="text" name="tel"><br>
住址<input type="text" name="adr"><br>
電子信箱<input type="text" name="mail"><br>
<input type="button" value="送出" onclick="chk(1)">
<script>
    function chk(submit)
	{
        var a = $("#a").val();
        if(a == "admin")	alert("無法使用admin當帳號");
		else
		{
			$.post("api.php?do=chk", {a}, function(r){
				if(r == "ok")
				{
                    if(submit)	$("#form").submit();
					else alert("帳號可以使用");
				}
				else alert("帳號無法使用");
			})	
		}
	}
</script>