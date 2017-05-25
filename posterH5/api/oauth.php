<?php
if(empty($_SESSION['user_id']))
{
    if($_SERVER['SERVER_NAME'] == "icbc2017.c.cescvip.com"){
        if(empty($_GET['openid']))
        {
            $url = "http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3fd08011ba040c5e&redirect_uri=https%3A%2F%2Fsmsb.icbc.com.cn%2FICBCSMSBank%2FWeChatRedirect%3Fact%3Dinfo%26channel%3D6%26k%3DPYQ&response_type=code&scope=snsapi_userinfo&state=icbc";
            header('Location:'.$url);
            exit;
        } else {
            include_once('../admin/include/init.php');
            $openid = !empty($_GET['openid']) ? htmlspecialchars($_GET['openid']) : "";
            $nickname = !empty($_GET['nickname']) ? htmlspecialchars($_GET['nickname']) : "";
            $headimgurl = !empty($_GET['headimgurl']) ? htmlspecialchars($_GET['headimgurl']) : "";
            if ($openid == "") {
                echo "非法请求";die;
            }
            if ($nickname == "") {
                echo "非法请求";die;
            }
            if ($headimgurl == "") {
                echo "非法请求";die;
            }
            $self = $DB->get_one("select * from user where openid='$openid'");
            if ($self) {
                $_SESSION['user_id'] = $self['id'];
            } else {
                $createTime = time();
                $insert = "insert into user(openid,nickname,createTime) values('$openid','$nickname','$createTime')";
                if ($DB->query($insert)) {
                    $_SESSION['user_id'] = $DB->insert_id();
                }else{
                }
            }
            header('Location:../index.php');
        }
    } else {
        $self_url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        if(empty($_GET['key']))
        {
            $url = "http://www.crazymoments.cn/wechat/setOauthUserInfo?url=".urlencode($self_url);
            header('Location:'.$url);
            exit;
        }
        if(!empty($_GET['key']))
        {
            $key=$_GET['key'];
            if($_SERVER['SERVER_NAME']=='poster.c.cescvip.com')
            {
                $url="http://www.crazymoments.cn/wechat/getOauthUserInfo?auth=81ds9dsi2r30des863i2309poster021&key='$key'";
            } else {
                $url="http://www.crazymoments.cn/wechat/getOauthUserInfo?auth=af1f30c08706c8fa418ffc54f2db585c&key='$key'";
            }
            $date=file_get_contents($url);
            $obj=json_decode($date,true);
            if(empty($obj['openid']))
            {
                $url = "http://www.crazymoments.cn/wechat/setOauthUserInfo?url=".urlencode($self_url);
                header('Location:'.$url);
                exit;
            }
            $openid = $obj['openid'];
            $nickname = $obj['nickname'];
            $avatar = $obj['headimgurl']; //头像
            $self = $DB->get_one("select * from user where openid='$openid'");
            if($self){
                $_SESSION['user_id'] = $self['id'];
            }else{
                $createTime = time();
                //$insert = "insert into user(openid,createTime) values('$openid','$createTime')";
                $insert = "insert into user(openid,nickname,avatar,createTime) values('$openid','$nickname','$avatar','$createTime')";
                if ($DB->query($insert)) {
                    $_SESSION['user_id'] = $DB->insert_id();
                }else{
                }
            }
        }
    }
}
