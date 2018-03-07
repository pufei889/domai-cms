<?php
require_once("../init.php");
$page = isset($_GET["page"])?(int)$_GET['page']:1;
if($page<1){
    header("HTTP/1.1 403 forbidden");
    echo "Unauthorized access";
    die;
}
$category = substr($_SERVER["REQUEST_URI"],1); 
$category = substr($category,0,strpos($category,"/"));
$category = str_replace("-"," ",$category);
$offset=($page-1)*pagecount;
$posts = $mysql->getRows("select * from posts where category = \"$category\" order by id desc limit $offset, ".pagecount);
$post=array();
if(empty($posts)){
    header("HTTP/1.1 404 Not Found");
    die;
}
?>
