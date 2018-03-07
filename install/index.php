<?php
header("Content-Type:text/html;charset=utf-8");
require_once("../init.php");
if(file_exists("./lock")){
    die("系统已经安装");
}
$sqls=str_replace(array("  ","\n","\t"),array(" ",""," "),file_get_contents("./struct.sql"));
foreach(explode("##",$sqls) as $sql){
    $mysql->query($sql);
}
$tmp=$mysql->getOne("select id from stat where 1=1");
if(empty($tmp[0])){
    die("安装失败");
}else{
    echo "安装成功";
    file_put_contents("./lock","安装成功!");
}
