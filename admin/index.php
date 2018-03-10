<?php
/*
 *后台管理界面
 */
require_once("./auth.php");
$page = isset($_GET["page"])?(int)$_GET['page']:1;
$numperpage=25;
$offset=($page-1)*$numperpage;
$posts = $mysql->getRows("select id,title,category,linkname from posts order by id desc limit $offset, $numperpage");
$post=array();
if(@$_GET['action']=='del'){
    $id = $_GET['id'];
    $tmp = $mysql->getOne("select category,linkname from posts where id = $id");
    if(!empty($tmp)){
        $mysql->query("delete from posts where id = $id");
        $l=$tmp['linkname'];
        $c=$tmp['category'];
        unlink(ABSPATH.get_link_name($c)."/".str_replace("%post_id%",$id,str_replace("%post_name%",$l,permanlink)).".gz");
        $c = $c==""?"top":$c;
        $tmp=$mysql->getOne("select stat from stat where id =1");
        $stat = @unserialize($tmp[0]);
        $stat[$c]=$stat[$c]-1;
        $stat['total']=$stat['total']-1;
        $mysql->query('update stat set stat = "'.addslashes(serialize($stat)).'" where id =1');
        echo "<script>window.location.reload();</script>";
        die;
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Simple Content Mangement System</title>
<style>
* {margin:0;padding:0}
html,body {width:100%;height:100%}
.left {width:200px;height:100%;float:left;margin-top:20px;text-align:center}
.right {float:left;margin-top:20px;}
.right table tr:nth-child(1) {background:#eee}
.right table {border-collapse:collapse}
.right table td {padding:5px 10px;border:1px solid #ccc}
.pages li {float:left;list-style:none;padding:10px 20px}
</style>
</head>
<body>
<div class="left">
    <ul>
        <li><a href="./">内容管理</a></li>
        <li><a href="./add.php">添加管理</a></li>
        <li><a href="./fix.php">数据修复</a></li>
    </ul>
</div>
<div class="right">
    <table>
        <tr>
            <td>ID</td><td>标题</td><td>栏目</td><td>操作</td>
        </tr>
<?php
while(have_posts()){
?>
    <tr><td><?php the_post_id()?></td><td><?php the_post_title();?></td><td><?php the_post_category();?></td><td><a href="./?action=del&id=<?php the_post_id()?>" onclick="return confirm('确认删除?')">删除</a><a href="<?php the_post_link();?>">查看</a></td></tr>
<?php
}
?>
    </table>
    <div class="pages">
<?php
the_paging_nav();
?>
    </div>
</div>
</body>
</html>
