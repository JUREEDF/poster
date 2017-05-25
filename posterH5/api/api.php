<?php
/*
 * ./api/api.php
 *   jianglingli
 *   2017/04/13
 * */
header("Cache-Control: no-cache");
header('Content-type:text/html;charset=utf-8');
include_once('../admin/include/init.php');
$status=! empty($_GET['status']) ? htmlspecialchars($_GET['status']) : 0;
if(empty($_SESSION['user_id']))
{
    echo json_encode(array("code" => 0, "msg" => '非法操作'),JSON_UNESCAPED_UNICODE);
    die;
}
if($status == '0'){
    echo json_encode(array("code" => 1, "msg" => '参数错误'),JSON_UNESCAPED_UNICODE);
    die;
}
$user_id = intval($_SESSION['user_id']);
if($status == 'posterInsert'){
    $list = $DB->get_one("select * from user where id=".$user_id);
    if(!$list){
        echo json_encode(array("code" => 0, "msg" => '非法操作'),JSON_UNESCAPED_UNICODE);
        die;
    }
    $base64 = !empty($_POST['image']) ? ($_POST['image']) : "";
    if($base64==""){
        echo json_encode(array("code" => 3, "msg" => '请上传图片！'),JSON_UNESCAPED_UNICODE);
        die;
    }
    $url = explode(',',$base64);
    $times = date('Y-m-d');
    $dir = ROOT."public/poster/".$times;
    if(!is_dir($dir))
    {
        @mkdir($dir,0777,true);
    }
    $path = "admin/public/poster/".$times.'/';
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)) {
        $fileName = time() . '_' . rand(1000, 9999) . '.' . $result[2];
        $save = file_put_contents($dir.'/'.$fileName, base64_decode($url[1]));//返回的是字节数
        if (!$save) {
            echo json_encode(array("code" => 8, "msg" => '失败！'),JSON_UNESCAPED_UNICODE);
            die;
        }
       $file = $path . $fileName;
    } else {
        echo json_encode(array("code" => 9, "msg" => '失败！'),JSON_UNESCAPED_UNICODE);
        die;
    }
    $image = $file;
    $result = $DB->insert('poster',array(
        'poster' => $image,
        'user_id' => $user_id,
    ));
    $poster_id = $DB->get_one("select id from poster where poster='$image'");
    $data['poster_id'] = $poster_id['id'];
    if($result){
        echo json_encode(array("code" => 6, "msg" => '成功！', "data" => $data),JSON_UNESCAPED_UNICODE);
        die;
    }else{
        echo json_encode(array("code" => 7, "msg" => '失败！3'),JSON_UNESCAPED_UNICODE);
        die;
    }
}


if($status == 'imageInsert'){
    $list = $DB->get_one("select * from user where id=".$user_id);
    if(!$list){
        echo json_encode(array("code" => 0, "msg" => '非法操作'),JSON_UNESCAPED_UNICODE);
        die;
    }
    $base64 = !empty($_POST['image']) ? ($_POST['image']) : "";
    $poster_id = !empty($_POST['poster_id']) ? ($_POST['poster_id']) : "";
    if($base64==""){
        echo json_encode(array("code" => 3, "msg" => '请上传图片！'),JSON_UNESCAPED_UNICODE);
        die;
    }
    if($poster_id==""){
        echo json_encode(array("code" => 10, "msg" => '参数错误！'),JSON_UNESCAPED_UNICODE);
        die;
    }
    $url = explode(',',$base64);
    $times = date('Y-m-d');
    $dir = ROOT."public/posterImage/".$times;
    if(!is_dir($dir))
    {
        @mkdir($dir,0777,true);
    }
    $path = "admin/public/posterImage/".$times.'/';
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)) {
        $fileName = time() . '_' . rand(1000, 9999) . '.' . $result[2];
        $save = file_put_contents($dir.'/'.$fileName, base64_decode($url[1]));//返回的是字节数
        if (!$save) {
            echo json_encode(array("code" => 8, "msg" => '失败！'),JSON_UNESCAPED_UNICODE);
            die;
        }
        $file = $path . $fileName;
    } else {
        echo json_encode(array("code" => 9, "msg" => '失败！'),JSON_UNESCAPED_UNICODE);
        die;
    }
    $image = $file;
    $result = $DB->insert('user_poster',array(
        'user_poster' => $image,
        'user_id' => $user_id,
        'poster_id' => $poster_id,
    ));
    if($result){
        echo json_encode(array("code" => 6, "msg" => '成功！'),JSON_UNESCAPED_UNICODE);
        die;
    }else{
        echo json_encode(array("code" => 7, "msg" => '失败！3'),JSON_UNESCAPED_UNICODE);
        die;
    }
}

//获取
if($status == 'getUser'){
    $list = $DB->get_one("select * from user where id=".$user_id);
    if(!$list){
        echo json_encode(array("code" => 0, "msg" => '非法操作'),JSON_UNESCAPED_UNICODE);
        die;
    }
    echo json_encode(array(
        "code" => 6,
        "msg" => '成功！',
        "data" => !empty($list)?$list:array(),
    ),JSON_UNESCAPED_UNICODE);
    die;

}

?>