<?php
/* 
 * 采集发布接口
 * 2018年3月2日 Hito
 */
require_once("../init.php");
if(empty($_POST)){
    header("HTTP/1.1 404 Not Found");
    die;
}
$_POST=array_map($_POST,'trim');
$post_title = $_POST['post_title'];
$post_content = $_POST['post_content'];
$post_excerpt = $_POST['post_excerpt'];
$post_category = $_POST['post_category'];
$post_category = $_POST['post_category'];
$post_date = $_POST['post_date'];
$post_thumbnail = $_POST['post_thumbnail'];

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
    $post=$mysql->getOne("select * from posts where id = $postid");
    if(save_post_html()){
        echo '{"url":"'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/fresh.php?pw='.submitpasswd.'","result":"Publish Success!"}';
        renew_stat($category);
    }else{
        echo '{"url":"https://www.baidu.com/","result":"Publish Success, But Failed to Generate a Page!"}';
        $mysql->query("delete from posts where id = $postid");
    }
}else{
    echo '{"url":"https://www.baidu.com/","result":"Publish Failure, Dataname Error!"}';
}
