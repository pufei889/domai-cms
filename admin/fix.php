<?php
/*
 *后台管理界面 统计数据修复
 */
require_once("./auth.php");
$stat=array();
$tmp = $mysql->getRows("select category, count(id) as count from posts group by category");
foreach($tmp as $t){
    if($t['category']=='') $t['category']='top';
    $stat[$t['category']]=$t['count'];
}
$mysql->query('update stat set stat = '.serialize($stat).' where id = 1');
header("content-type:text/html;charset=utf-8");
echo "修复成功!";
echo "<script>setTimeout(function(){window.history.go(-1)},3000);</script>";
