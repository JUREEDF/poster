<?php
include_once('./include/init.php');
if(!empty($_SESSION['user_name'])){
    header("location:index.php");die;
}
header("Content-type:text/html;charset=utf-8");
$username=@$_POST['username'];
$pwd=md5(md5(@$_POST['pwd'].''."aaaaa"));
$result=$DB->query("select * from user_admin where name='$username'");
$row=$DB->fetch_array($result);
if(@$row[password]==$pwd){
    $_SESSION['user_name']=$username;
    $_SESSION['user_admin_id']=$row[id];
    header("location:index.php");die;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link href="public/css/admin_login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_login_wrap">
    <h1>后台管理</h1>
    <div class="adming_login_border">
        <div class="admin_input">
            <form action="" method="post">
                <ul class="admin_items">
                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="username" value="" id="user" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="pwd" value="" id="pwd" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
</html>