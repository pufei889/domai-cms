<?php
/* 
 * 采集发布接口
 * 2018年3月2日 Hito
 */
require_once("./init.php");
if(empty($_POST)){
    header("HTTP/1.1 404 Not Found");
    die;
}
header("Content-Type:application/json");
if(empty($_GET['secret']) || $_GET['secret'] !=submitpasswd){
    echo '{"url":"https://www.baidu.com/","result":"Publish Failure, Bad Password!"}';
    die;
}
$title = @space_replace($_POST['post_title']);
$content = @space_replace($_POST['post_content']);
$category = @space_replace($_POST['post_category']);
//获取linkname
$linkname = get_link_name($title);

if(empty($title) || empty($content)){
    echo '{"url":"https://www.baidu.com/","result":"Publish Failure,Title or Content Empty!"}';
    die;
}
if($category==""){
    echo '{"url":"https://www.baidu.com/","result":"Publish Failure, Must Specified a Category!"}';
    die;
}else if($category=="top"){
    $category="";
}
//截取描述字段
$description =get_description($content);
//获取post_date
$post_date= date("Y-m-d H:i:s");

//写入数据库
$mysql->query("insert into posts (title,linkname,description,category,post_time) values(\"$title\",\"$linkname\",\"$description\",\"$category\",\"$post_date\")");
if($mysql->get_error()==0){
    $tmp = $mysql->getOne("select last_insert_id()");
    $postid = $tmp[0];
    if(save_post_html()){
        echo '{"url":"'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/fresh.php","result":"Publish Success!"}';
        renew_stat($category);
    }else{
        echo '{"url":"https://www.baidu.com/","result":"Publish Success, But Failed to Generate a Page!"}';
        $mysql->query("delete from posts where id = $postid");
    }
}else{
    echo '{"url":"https://www.baidu.com/","result":"Publish Failure, Dataname Error!"}';
}
