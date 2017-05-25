<?php
/**
 * Created by init.php
 * Author: LiaoJiangYi
 * Date: 2015/8/20 13:56
 */
//ini_set("session.save_handler","redis");
//ini_set("session.save_path","tcp://123.57.4.189:6379?auth=3visoRedis2015");
session_start();
define('JYLIAO',true);
define('charset','utf-8');
define('ROOT',dirname(__DIR__).DIRECTORY_SEPARATOR);
define('WEB_ROOT',dirname(ROOT).DIRECTORY_SEPARATOR);
define('INC',ROOT.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR);
include_once(ROOT.'config.php');
include_once(INC.'mysqlpdo.class.php');
include_once(INC.'fileupload.class.php');
include_once(INC.'winning.class.php');
include_once(INC.'wechat.class.php');
$config = array(
    "host" => DB_SERVER,
    "port" => DB_PORT,
    "user" => DB_USER,
    "pwd" => DB_PWD,
    "name" => DB_DB,
);
$DB = new mysqlpdo($config);
function msg($msgs,$gourl='',$onlymsg=0,$limittime=0){//提示信息
    $msg='';
    if(empty($GLOBALS['cfg_phpurl'])) $GLOBALS['cfg_phpurl'] = '.';
    if(is_array($msgs)){
        foreach($msgs as $v)$msg.=$v.'<Br>';
        $title=$gourl;
        $gourl=$onlymsg;
        $onlymsg=0;
    }else{
        $msg=$msgs;
        $title="提示信息！";
    }
    $htmlhead  = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<title>提示信息！</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".charset."\" />\r\n";
    $htmlhead .= "<base target='_self'/>\r\n<style>div{line-height:160%;}</style></head>\r\n<body leftmargin='0' topmargin='0'>".(isset($GLOBALS['ucsynlogin']) ? $GLOBALS['ucsynlogin'] : '')."\r\n<center>\r\n<script>\r\n";
    $htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n";
    $litime = ($limittime==0 ? 3000 : $limittime);
    $func = '';
    if($gourl=='-1'){
        if($limittime==0) $litime = 5000;
        $gourl = "javascript:history.back();";
    }
    if($gourl=='' || $onlymsg==1){
        $msg = "<script>alert(\"".str_replace("\"","",$msg)."\");</script>";
    }else{
        if(preg_match('/close\:\:/',$gourl)){
            $tgobj = trim(preg_replace('/close\:\:/', '', $gourl));
            $gourl = 'javascript:;';
            $func .= "window.parent.document.getElementById('{$tgobj}').style.display='none';\r\n";
        }
        $func .= "      var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='$gourl'; pgo=1; }
      }\r\n";
        $rmsg = $func;
        $rmsg .= "document.write(\"<br /><div style='width:450px;padding:0px;border:1px solid #D1DDAA;'>";
        $rmsg .= "<div style='padding:6px;font-size:12px;border-bottom:1px solid #D1DDAA;background:#DBEEBD;'><b>".$title."</b></div>\");\r\n";
        $rmsg .= "document.write(\"<div style='font-size:10pt; padding:0px 5px 30px 5px;background:#ffffff'><br />\");\r\n";
        $rmsg .= "document.write(\"".str_replace("\"","",$msg)."\");\r\n";
        $rmsg .= "document.write(\"";
        if($onlymsg==0 && is_numeric($onlymsg)){
            if( $gourl != 'javascript:;' && $gourl != ''){
                $rmsg .= "<br /><a href='{$gourl}'>如果您的浏览器没有反应，请点击...</a>";
                $rmsg .= "<br/></div>\");\r\n";
                $rmsg .= "setTimeout('JumpUrl()',$litime);";
            }else{
                $rmsg .= "<br/></div>\");\r\n";
            }
        }else{
            $rmsg .= "<br/><br/></div>\");\r\n";
        }
        $msg  = $htmlhead.$rmsg.$htmlfoot;
    }
    echo $msg;
    exit;
}
function GetIP()
{
    if(!empty($_SERVER["HTTP_CLIENT_IP"]))
    {
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }
    else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    else if(!empty($_SERVER["REMOTE_ADDR"]))
    {
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    else
    {
        $cip = '';
    }
    preg_match("/[\d\.]{7,15}/", $cip, $cips);
    $cip = isset($cips[0]) ? $cips[0] : 'unknown';
    unset($cips);
    return $cip;
}
function pageHtml($page,$total,$pageSize=20,$strunit="",$url='',$target=''){
    $pageSize=intval($pageSize);
    $page=$page?intval($page):1;
    $lastpg=ceil($total/$pageSize); //最后页，也是总页数
    $page=min($lastpg,$page);
    $prepg=(($page-1)<0)?"0":$page-1; //上一页
    $nextpg=($page==$lastpg ? 0 : $page+1); //下一页
    if (isset($_SERVER['QUERY_STRING']))
    {
        $REQUEST_URI=$_SERVER['QUERY_STRING']?$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']:$_SERVER['PHP_SELF'];
    }
    !$url && $url=$_SERVER["REQUEST_URI"]?$_SERVER["REQUEST_URI"]:$REQUEST_URI;
    $_parse_url=parse_url($url);
    isset($_parse_url["query"]) ? $url_query=$_parse_url["query"] : $url_query='';//单独取出URL的查询字串
    if($url_query){
        $url_query=preg_replace("/(^|&)page\=$page/","",$url_query);
        $url=str_replace($_parse_url["query"],$url_query,$url);
        $url.=$url_query?"&page":"page";
    }else {
        $url.="?page";
    }
    $pagenav=" <a href='$url=1' target='_self'>首页</a> ";
    $pagenav.=$prepg?" <a href='$url=$prepg' target='_self'>上一页</a> ":" 上一页 ";
    $flag=0;
    for($i=$page-2;$i<$page;$i++){
        if($i<1) continue;
        $pagenav.="<a href='$url=$i' target='_self'>[$i]</a>";
    }
    $pagenav.="&nbsp;<b>$page</b>&nbsp;";
    for($i=$page+1;$i<=$lastpg;$i++){
        $pagenav.="<a href='$url=$i' target='_self'>[$i]</a>";
        $flag++;
        if($flag==4) break;
    }
    $pagenav.=$nextpg?" <a href='$url=$nextpg' target='_self'>下一页</a> ":" 下一页 ";
    $pagenav.=" <a href='$url=$lastpg' target='_self'>末页</a> ";
    $pagenav.="共{$total}{$strunit}，{$pageSize}{$strunit}/页 ";
    $pagenav.=" 共{$lastpg}页";
    (int)$lastpg<2 &&$pagenav='';
    return $pagenav;
}
function removeEmoji($clean_text) {
    // Match Emoticons
    $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
    $clean_text = preg_replace($regexEmoticons, '', $clean_text);

    // Match Miscellaneous Symbols and Pictographs
    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
    $clean_text = preg_replace($regexSymbols, '', $clean_text);

    // Match Transport And Map Symbols
    $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
    $clean_text = preg_replace($regexTransport, '', $clean_text);

    // Match Miscellaneous Symbols
    $regexMisc = '/[\x{2600}-\x{26FF}]/u';
    $clean_text = preg_replace($regexMisc, '', $clean_text);

    // Match Dingbats
    $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
    $clean_text = preg_replace($regexDingbats, '', $clean_text);

    return $clean_text;
}
function text_replace($string){
    $arr = explode('</p>',$string);
    for($i=0;$i<count($arr);$i++){
        $content = str_replace("p>","",$arr[$i]);
        $content = str_replace("<","",$content);
        $content = str_replace("/>","",$content);
        $content = str_replace("&nbsp;","",$content);
        $content = str_replace("br","",$content);
        $arr[$i] = array(
            "type" => "p" ,
            "html" => $content ,

        );
        if(strstr($arr[$i]['html'],"img")){
            //$pattern="/img src=\"(.*)\" />/";//正则
            $pattern="/img src=\"(.*)\" title=\"(.*)\" alt=\"(.*)\"/";//正则
            preg_match_all($pattern,$arr[$i]['html'], $htmls);
            $arr[$i] = array(
                "type" => "image" ,
                "html" => $htmls[1][0] ,

            );
        }
        if($arr[$i]['html'] == ""){
            unset($arr[$i]);
        }
    }
   return $arr;
}

class fore
{
    // 递归循环
    public function digui($data, $p_path, $level)
    {
        static $arr = array();
        foreach ($data as $key => $val) {
            if ($val['parent_id'] == $p_path) {
                $val['level'] = $level;
                $arr[] = $val;
                $this->digui($data, $val['id'], $level + 1);
            }
        }
        return $arr;
    }
}