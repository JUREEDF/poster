<?php
include_once('./include/init.php');
if (empty($_SESSION['user_name'])) {
    header("location:login.php");
    die;
}
include_once('./public/menu.php');
$a = !empty($_GET['a']) ? trim($_GET['a']) : '';
$id = !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
if($a=='del')
{
    $result = $DB->get_one('SELECT * FROM `poster` WHERE id=' . $id);
    if (!$result) msg('信息不存在', '-1');
    if ($DB->query('DELETE FROM `poster` WHERE id='.$id)) {
        msg('删除成功','index.php');
    }
}

$where = ' WHERE 1';

$page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
$id = !empty($_GET['id']) ? intval($_GET['id']) : 1;
if($id){
    $where .= ' AND poster.user_id='.$id;
}
$page = max($page, 1);
$pageSize = 10;
$offset = array(($page - 1) * $pageSize, $pageSize);
$sql = "select COUNT(id) AS c from `poster`".$where.' ORDER BY poster.`id` DESC';
$var = $DB->get_one($sql);
$count = $var['c'];
?>
<div class="main-wrap">
    <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span class="crumb-step">&gt;</span>
        </div>
    </div>
    <div class="result-wrap">
        <form name="myform" id="myform" method="get">
            <div class="result-title">
                <!--                <div class="result-list">-->
                <!--                    关键字: <input name="keyword" value="" placeholder="">-->
                <!--                    <button>搜索</button>-->
                <!--                </div>-->
            </div>
        </form>
        <div class="result-content">
            <table class="result-tab" width="80%">
                <tr>
                    <th width="15%">编号</th>
                    <th>图片</th>
                    <th>海报</th>
                </tr>
                <?php
                $sqls = 'select * from poster left JOIN user_poster on poster.id=user_poster.poster_id'.$where.' ORDER BY poster.`id` DESC LIMIT ' . $offset[0] . ',' . $offset[1];
//                echo $sqls;die;
                $query = $DB->query($sqls);
                while ($val = $DB->fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $val['id']; ?></td>

                        <td><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$val['poster']; ?>" alt="" style="height: auto;width: auto"></td>
                        <td><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$val['user_poster']; ?>" alt="" style="height: 50%;width: 50%"></td>
                    </tr>
                <?php } ?>
            </table>
            <div class="list-page"><?php echo pageHtml($page, $count, $pageSize); ?></div>
        </div>
    </div>
</div>
</body>
</html>