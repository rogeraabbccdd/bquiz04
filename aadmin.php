<input type="button" onclick="lof('admin.php?redo=newa')" value="新增管理員帳號">
<table>
    <tr>
        <td>帳號</td>
        <td>密碼</td>
        <td>管理</td>
    </tr>
    <?php
        $result = mysqli_query($link, "select * from admin");
        while($row = mysqli_fetch_array($result))
        {
            ?>
                <tr>
                    <td><?=$row["acc"]?></td>
                    <td><?=$row["pw"]?></td>
                    <td>
                        <?php
                            if($row["acc"] == "admin")  echo "此帳號為最高權限";
                            else
                            {
                                ?>
                                <button type="button" onclick="lof('admin.php?do=edita&id=<?=$row["id"]?>')">編輯</button>
                                <button type="button" onclick="lof('api.php?do=deladmin&id=<?=$row["id"]?>')">刪除</button>
                                <?php
                            }
                        ?>
                    </td>
                </tr>
            <?php
        }
    ?>
</table>