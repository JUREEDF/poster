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
    $result = $DB->get_one('SELECT * FROM `user` WHERE id=' . $id);
    if (!$result) msg('信息不存在', '-1');
    if ($DB->query('DELETE FROM `user` WHERE id='.$id)) {
        msg('删除成功','index.php');
    }
}

$where = ' WHERE 1';

$page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
$page = max($page, 1);
$pageSize = 10;
$offset = array(($page - 1) * $pageSize, $pageSize);
$sql = "select COUNT(id) AS c from `user`".$where.' ORDER BY `id` DESC';
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
            <table class="result-tab" width="100%">
                <tr>
                    <th width="15%">编号</th>
                    <th>头像</th>
                    <th width="20%">昵称</th>
                    <th width="20%">海报数量</th>
                    <th width="20%">添加时间</th>
                    <th width="10%">操作</th>
                </tr>
                <?php
                $sqls = 'SELECT id,nickname,avatar,createTime FROM `user` '.$where.' ORDER BY `id` DESC LIMIT ' . $offset[0] . ',' . $offset[1];
                $query = $DB->get_all($sqls);
                foreach($query as $val) {
                    ?>
                    <tr>
                        <td><?php echo $val['id']; ?></td>
                        <td><img src="<?php echo $val['avatar']; ?>" alt="" style="height: 80px;width: 80px"></td>
                        <td><?php echo $val['nickname']; ?></td>
                        <td><?php
                            $num = $DB->get_one("SELECT count(id) as c FROM `poster` WHERE 1 AND user_id=".$val['id']);
                            echo $num['c'];
                            ?></td>

                        <td><?php echo date("Y-m-d H:i:s", $val['createTime']); ?></td>
                        <td>
                            <a href="poster_list.php?id=<?php echo $val['id'];?>">海报列表</a>
                            <a href="?a=del&id=<?php echo $val['id'];?>" onclick="return confirm('确定删除此信息？');">删除</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <div class="list-page"><?php echo pageHtml($page, $count, $pageSize); ?></div>
        </div>
    </div>
</div>
</body>
</html>